<?php

namespace Medians\Messages\Application;

use Medians\Contacts\Infrastructure\ContactRepository;
use Medians\Messages\Infrastructure\MessageRepository;

class MessageController extends MessageService
{




	/**
	 * Admin index items
	 * 
	 */ 
	public function loadMedia( $mediaid) 
	{
        // $Media = $this->getMedia('/'.$mediaid);
        $filename = $this->saveMedia('/'.$mediaid);

        $repo = new MessageRepository;
        $repo->updateMedia($mediaid, $filename);
    }


	/**
	 * Admin index items
	 * 
	 */ 
	public function load_messages( ) 
	{
        $repo = new MessageRepository;
        
        $app = new \config\APP;
        $data =  $repo->loadMessages($app->request()->get('active_contact'));
        echo $data;

        foreach ($data as $key => $value) {
            if ($value->media_id && !$value->media_path)
            {
                $this->loadMedia($value->media_id);
            }
        }
    }

	/**
	 * Load contacts
	 * 
	 */ 
	public function load_contacts( ) 
	{
        $repo = new ContactRepository;
        
        $data =  $repo->loadContacts();
        echo json_encode(['contacts'=>$data]);

    }

    
    /**
     * Upload file at WP cloud storage
     * and seve the sent messge ID 
     * 
     * @param $file new APP::request()->files[0]
     */
    public function uploadAndSave($file, $type = 'image')
    {
		$MessageService = new MessageService;
        $messageSent = $MessageService->uploadMedia($file);
        
        $data['media_id'] = $messageSent->id;
        $data['to'] = $messageSent->contacts[0]->wa_id;
        $data['sender_id'] = $MessageService->PNID;
        $message = $messageSent->messages[0];
        $data['message_type'] = $type;
        $data['message_id'] = isset($message->id) ? $message->id : '';
        $data['media_path'] = $file;
        
        $MessageRepository = new \Medians\Messages\Infrastructure\MessageRepository;
        $MessageRepository->saveMessage($data, $data['sender_id']);

        return $MessageRepository;
    }
    
    public function uploadImage()
    {
        
        $app = new \Config\APP;
		$Media = new \Medians\Media\Infrastructure\MediaRepository;
		foreach ($app->request()->files as $key => $value) {
			$file = $Media->upload($value);
		}
        
        $this->uploadAndSave($file);
        
    }

    public function uploadFile()
    {
        
        $app = new \Config\APP;
        $MessageService = new MessageService;
		$Media = new \Medians\Media\Infrastructure\MediaRepository;
		foreach ($app->request()->files as $key => $value) {
			$file = $Media->upload($value);
            $this->uploadAndSave($file, $MessageService->getFileType($value));
		}
    }


	/**
	 * Admin index items
	 * 
	 */ 
	public function index( ) 
	{
        
        $repo = new MessageRepository;
        
		try {
			
		    return render('chat', [
		        'load_vue' => true,
		        'title' => __('messages'),
		        'messages' => $repo->loadMessages(),
		        'contacts' => $repo->loadContacts(),
		        'contacts' => $repo->loadContacts(),
		    ]);
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
			
		}
	}


    
	/**
	 * Webhooks method 
	 * @var Int
	 */
	public function webhook()
	{

        $app = new \config\APP;

        $challenge = $app->request()->get('hub_challenge');
        // $verify_token = $app->request()->get('hub_verify_token');
        if($challenge)
        {
            echo $challenge;
            die();
        }                

        $rawData = file_get_contents('php://input');
        $jsonData = json_decode($rawData, true);
        
        if ($jsonData) {
                  
            $jsonData = json_decode(json_encode($jsonData, JSON_PRETTY_PRINT));
            $dataToSave = json_encode($jsonData, JSON_PRETTY_PRINT);
            $time = time();
            file_put_contents($time.'.json', $dataToSave);
        }

        if ($jsonData) {
                  
            $jsonData = json_decode(json_encode($jsonData, JSON_PRETTY_PRINT));
            if (isset($jsonData->entry[0]->changes[0]->value->contacts[0]->profile->name))
            {
                $data = array();
                if (isset($jsonData->entry[0]->changes[0]->value->messaging_product))
                {
                    $data['conversation_id'] = $jsonData->entry[0]->id;
                    $data['name'] = $jsonData->entry[0]->changes[0]->value->contacts[0]->profile->name;
                    $data['sender_id'] = $jsonData->entry[0]->changes[0]->value->contacts[0]->wa_id;
                    $data['to'] = $jsonData->entry[0]->changes[0]->value->metadata->phone_number_id;
                    $message = $jsonData->entry[0]->changes[0]->value->messages[0];
                    $data['message_id'] = isset($message->id) ? $message->id : '';
                    $data = $this->messageTypeHandler($data, $message, isset($time) ? $_SERVER['DOCUMENT_ROOT'].'/'.$time.'.json' : null);
                    isset($data['media_id']) ? $this->loadMedia( $data['media_id']) : '';
                }
                
                
                $MessageRepository = new \Medians\Messages\Infrastructure\MessageRepository;
                
                $contact = array();
                $contact['name'] = $jsonData->entry[0]->changes[0]->value->contacts[0]->profile->name;
                $contact['wa_id'] = $jsonData->entry[0]->changes[0]->value->contacts[0]->wa_id;
                $contact['phone_number'] = $jsonData->entry[0]->changes[0]->value->contacts[0]->wa_id;
                $MessageRepository->saveContact($contact);

                $MessageRepository->saveMessage($data, $data['sender_id']);

                

            }
        }
    }


    /**
     * Messages type handler
     * 
     */
    public function messageTypeHandler($data, $message, $messageFile = null)
    {
 
            
        switch ($message->type) {
            case 'document':
                $data['media_id'] = isset($message->document->id) ? $message->document->id : '';
                $data['message_text'] = isset($message->document->caption) ? str_replace("\\","\\\\", $message->document->caption) : '';
                break;
                
            case 'audio':
                $data['media_id'] = isset($message->audio->id) ? $message->audio->id : '';
                $data['message_text'] = isset($message->audio->caption) ? str_replace("\\","\\\\", $message->audio->caption) : '';
                break;
                
            case 'video':
                $data['media_id'] = isset($message->video->id) ? $message->video->id : '';
                $data['message_text'] = isset($message->video->caption) ? str_replace("\\","\\\\", $message->video->caption) : '';
                break;
                
            case 'image':
                $data['media_id'] = isset($message->image->id) ? $message->image->id : '';
                $data['message_text'] = isset($message->image->caption) ? str_replace("\\","\\\\", $message->image->caption) : '';
                break;
                
            case 'sticker':
                $data['media_id'] = isset($message->sticker->id) ? $message->sticker->id : '';
                break;
                
            default:
                $data['message_text'] = isset($message->text->body) ? str_replace("\\","\\\\", $message->text->body) : '';
                break;
        }
            
        $data['message_type'] = isset($message->type) ? $message->type : '';
        $data['media_path'] = isset($data['media_id']) ?  $this->loadMedia($data['media_id']) : '';

        return $data;
    }

    
    
	/**
	 * Front page 
	 * @var Int
	 */
	public function page($item)
	{

		try {
			
            $service = new MessageService; 
            $app = new \config\APP;
            
            switch ($item) {
                case 'chat':
                    return $service->request_code();
                    break;
                
                case 'handle_messages':
                    return $this->handle_messages();
                    break;
                
               case 'send_text':
                    return $service->sendTextMessage($app->request()->get('m'), $app->request()->get('wa_id'));
                    break;
                
               case 'numbers':
                    return $this->saveNumber();
                    break;
                
                default:
                    # code...
                    break;
            }

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	} 


    public function handle_messages()
    {
        print_r('s');
        foreach (glob($_SERVER['DOCUMENT_ROOT'].'/*.json') as $key => $value) 
        {
            print_r(json_decode(file_get_contents($value)));
        }
	} 


    public function saveNumber()
    {
        $service = new MessageService; 
        $object = json_decode($service->getPhoneNumbers());

        $data = array();
        $data['name'] = $object->data[0]->verified_name;
        $data['phone_number'] = $object->data[0]->display_phone_number;
        $data['wa_id'] = $object->data[0]->id;
        
        $repo = new MessageRepository;
        return $repo->saveContact($data);

    }


}
