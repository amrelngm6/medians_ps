<?php

namespace Medians\Messages\Application;

class MessageController
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
            if (isset($jsonData->entry[0]->changes[0]->value->contacts[0]->profile->name))
            {
                $data = array();
                if (isset($jsonData->entry[0]->changes[0]->value->messaging_product))
                {
                    $data['conversation_id'] = $jsonData->entry[0]->id;
                    $data['name'] = $jsonData->entry[0]->changes[0]->value->contacts[0]->profile->name;
                    $data['wa_id'] = $jsonData->entry[0]->changes[0]->value->contacts[0]->wa_id;
                    $data['receiver_id'] = $jsonData->entry[0]->changes[0]->value->metadata->phone_number_id;
                    $data['sender_id'] = $jsonData->entry[0]->changes[0]->value->metadata->display_phone_number;
                    $message = $jsonData->entry[0]->changes[0]->value->messages[0];
                    $data['message_text'] = isset($message->text->body) ? $message->text->body : '';
                    $data['message_id'] = isset($message->id) ? $message->id : '';
                    $data['media_id'] = isset($message->image->id) ? $message->image->id : '';
                }

            }
        }

		$MessageRepository = new \Medians\Messages\Infrastructure\MessageRepository;
		$MessageRepository->saveMessage($data, $this->PNID);
    }
    
    
	/**
	 * Front page 
	 * @var Int
	 */
	public function page($item)
	{

		try {
			
            $service = new MessageService; 

            switch ($item) {
                case 'chat':
                    return $service->request_code();
                    break;
                
               case 'send':
                    return $service->sendTextMessage();
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
