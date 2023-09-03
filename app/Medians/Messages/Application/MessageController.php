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
        
        $rawData = file_get_contents('php://input');
        $jsonData = json_decode($rawData, true);
            
        if ($jsonData) {
                  
            $jsonData = json_decode(json_encode($jsonData, JSON_PRETTY_PRINT));
            if (isset($jsonData->entry[0]->changes[0]->value->contacts[0]->profile->name))
            {
                $data = array();
                if (isset($jsonData->entry[0]->changes[0]->value->messaging_product))
                {
                    $jsonData['conversation_id'] = $jsonData->entry[0]->id;
                    $jsonData['name'] = $jsonData->entry[0]->changes[0]->value->contacts[0]->profile->name;
                    $jsonData['wa_id'] = $jsonData->entry[0]->changes[0]->value->contacts[0]->wa_id;
                    $jsonData['receiver_id'] = $jsonData->entry[0]->changes[0]->value->metadata->phone_number_id;
                    $jsonData['sender_id'] = $jsonData->entry[0]->changes[0]->value->metadata->display_phone_number;
                    $message = $jsonData->entry[0]->changes[0]->value->messages[0];
                    $jsonData['message_text'] = isset($message->text->body) ? $message->text->body : '';
                    $jsonData['message_id'] = isset($message->id) ? $message->id : '';
                    $jsonData['media_id'] = isset($message->image->id) ? $message->image->id : '';
                }

            }
        }

        

		$MessageRepository = new \Medians\Messages\Infrastructure\MessageRepository;

		$response = json_decode($this->wp_web_send($path, $data));
		$data['message_id'] = $response->messages[0]->id;
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
