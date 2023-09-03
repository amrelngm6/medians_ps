<?php

namespace Medians\Messages\Application;

class MessageController extends MessageService
{




    
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
            file_put_contents(time().'.json', $dataToSave);
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
                    $data['to'] = $jsonData->entry[0]->changes[0]->value->contacts[0]->wa_id;
                    $data['sender_id'] = $jsonData->entry[0]->changes[0]->value->metadata->phone_number_id;
                    $message = $jsonData->entry[0]->changes[0]->value->messages[0];
                    $data['message_id'] = isset($message->id) ? $message->id : '';
                    $data = $this->messageTypeHandler($data, $message);
                    
                }

                $MessageRepository = new \Medians\Messages\Infrastructure\MessageRepository;
                $MessageRepository->saveMessage($data, $data['sender_id']);
            }
        }

    }

    /**
     * Messages type handler
     * 
     */
    public function messageTypeHandler($data, $message)
    {
        
        switch ($message->type) {
            case 'document':
                $data['media_id'] = isset($message->document->id) ? $message->document->id : '';
                $data['message_text'] = isset($message->document->caption) ? $message->document->caption : '';
                break;
                
            case 'audio':
                $data['media_id'] = isset($message->audio->id) ? $message->audio->id : '';
                $data['message_text'] = isset($message->audio->caption) ? $message->audio->caption : '';
                break;
                
            case 'video':
                $data['media_id'] = isset($message->video->id) ? $message->video->id : '';
                $data['message_text'] = isset($message->video->caption) ? $message->video->caption : '';
                break;
                
            case 'image':
                $data['media_id'] = isset($message->image->id) ? $message->image->id : '';
                $data['message_text'] = isset($message->image->caption) ? $message->image->caption : '';
                break;
                
            case 'sticker':
                $data['media_id'] = isset($message->sticker->id) ? $message->sticker->id : '';
                break;
                
            default:
                $data['message_text'] = isset($message->text->body) ? $message->text->body : '';
                break;
            }
            
        $data['message_type'] = isset($message->type) ? $message->type : '';

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
                
               case 'send_text':
                    return $service->sendTextMessage($app->request()->get('m'));
                    break;
                
                default:
                    # code...
                    break;
            }

		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), 1);
		}
	} 


}
