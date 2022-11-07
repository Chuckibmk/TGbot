<?php
// $input = file_get_contents('php://input');
// $update = json_decode($input);
// $message = $update->message;
// $chat_id = $message->chat->id;
// $text = $message->text;
// // $calldata = $update->callback_query->data;

    $update = json_decode(file_get_contents('php://input'), TRUE);

    // $botToken = "5626488654:AAEZQtWVgZL7XXiQdCUHh2qw4bVJPKxjZig";
    $botToken = "<your token>";
    $botAPI = "https://api.telegram.org/bot" . $botToken;

    // Ist Menu
    if (isset($update['callback_query'])) {
        $data = $update['callback_query']['data'];
        // subscription sub menu
        if($data === 'signa'){
            
           // Reply with callback_query data
            $data = http_build_query([
                'text' => 'Please choose Subcription you want to view.',
                'chat_id' => $update['callback_query']['from']['id']
            ]);
            
            $keyboard = json_encode(
                    ['inline_keyboard' => [
                	    [
                	        ['text' => 'All Signals', 'callback_data' => 'allsig']
                	    ],
                	    [
                	        ['text' => 'Accuracy above 85%', 'callback_data' => 'accu85']
                	    ],
                	    [
                	        ['text' => 'Accuracy above 90%', 'callback_data' => 'accu90']
                	    ],
                	    [
                	        ['text' => 'Main Menu', 'callback_data' => 'mainme']
                	    ]
                	]]
                );

            
            file_get_contents($botAPI . "/sendMessage?{$data}&reply_markup={$keyboard}"); 
        }
        //
        if($data === 'allsig'){
            
           // Reply with callback_query data
            $data = http_build_query([
                'text' => 'Successfully updated desired Subcription.',
                'chat_id' => $update['callback_query']['from']['id']
            ]);
            
            $keyboard = json_encode(
                    ['inline_keyboard' => [
                	    [
                	        ['text' => 'Main Menu', 'callback_data' => 'mainme']
                	    ]
                	]]
                );

            
            file_get_contents($botAPI . "/sendMessage?{$data}&reply_markup={$keyboard}"); 
        }
        if($data === 'accu85'){
            
           // Reply with callback_query data
            $data = http_build_query([
                'text' => 'Successfully updated desired Subcription.',
                'chat_id' => $update['callback_query']['from']['id']
            ]);
            
            $keyboard = json_encode(
                    ['inline_keyboard' => [
                	    [
                	        ['text' => 'Main Menu', 'callback_data' => 'mainme']
                	    ]
                	]]
                );

            
            file_get_contents($botAPI . "/sendMessage?{$data}&reply_markup={$keyboard}"); 
        }
        if($data === 'accu90'){
            
           // Reply with callback_query data
            $data = http_build_query([
                'text' => 'Successfully updated desired Subcription.',
                'chat_id' => $update['callback_query']['from']['id']
            ]);
            
            $keyboard = json_encode(
                    ['inline_keyboard' => [
                	    [
                	        ['text' => 'Main Menu', 'callback_data' => 'mainme']
                	    ]
                	]]
                );

            
            file_get_contents($botAPI . "/sendMessage?{$data}&reply_markup={$keyboard}"); 
        }
        
        //Subscript sub menu
        if($data === 'subscr'){
            
           // Reply with callback_query data
            $nl = urlencode("\n");
            $txt = "After selecting the package and payment method, you will receive an invoice. 🧾".$nl;
            $txt .= "Please carefully copy the payment address and the amount into a wallet or exchange!";
            
            $chat_id = $update['callback_query']['from']['id'];
            
            $keyboard = json_encode(
                    ['inline_keyboard' => [
                	    [
                	        ['text' => '0.025000000 BTC - 1 month', 'callback_data' => '1mont']
                	    ],
                	    [
                	        ['text' => '0.050000000 BTC - 3 months', 'callback_data' => '2mont']
                	    ],
                	    [
                	        ['text' => '0.100000000 BTC - 12 months', 'callback_data' => '3mont']
                	    ],
                	    [
                	        ['text' => 'Main Menu', 'callback_data' => 'mainme']
                	    ]
                	]]
                );

            
            file_get_contents($botAPI . "/sendMessage?chat_id=$chat_id&text=$txt&reply_markup={$keyboard}"); 
        }
        //
        if($data === '1mont'){
            
           // Reply with callback_query data
            $txt = "Please choose currency:";

            $chat_id = $update['callback_query']['from']['id'];
            
            $keyboard = json_encode(
                    ['inline_keyboard' => [
                	    [
                	        ['text' => 'Pay With BTC', 'callback_data' => 'proced']
                	    ],
                	    [
                	        ['text' => 'Pay With ETH', 'callback_data' => 'proced']
                	    ],
                	    [
                	        ['text' => 'Pay With USDT', 'callback_data' => 'proced']
                	    ],
                	    [
                	        ['text' => 'Back', 'callback_data' => 'subscr']
                	    ]
                	]]
                );

            
            file_get_contents($botAPI . "/sendMessage?chat_id=$chat_id&text=$txt&reply_markup={$keyboard}"); 
        }
        if($data === '2mont'){
            
           // Reply with callback_query data
            $txt = "Please choose currency:";

            $chat_id = $update['callback_query']['from']['id'];
            
            $keyboard = json_encode(
                    ['inline_keyboard' => [
                	    [
                	        ['text' => 'Pay With BTC', 'callback_data' => 'proced']
                	    ],
                	    [
                	        ['text' => 'Pay With ETH', 'callback_data' => 'proced']
                	    ],
                	    [
                	        ['text' => 'Pay With USDT', 'callback_data' => 'proced']
                	    ],
                	    [
                	        ['text' => 'Back', 'callback_data' => 'subscr']
                	    ]
                	]]
                );

            
            file_get_contents($botAPI . "/sendMessage?chat_id=$chat_id&text=$txt&reply_markup={$keyboard}"); 
        }
        if($data === '3mont'){
            
           // Reply with callback_query data
            $txt = "Please choose currency:";

            $chat_id = $update['callback_query']['from']['id'];
            
            $keyboard = json_encode(
                    ['inline_keyboard' => [
                	    [
                	        ['text' => 'Pay With BTC', 'callback_data' => 'proced']
                	    ],
                	    [
                	        ['text' => 'Pay With ETH', 'callback_data' => 'proced']
                	    ],
                	    [
                	        ['text' => 'Pay With USDT', 'callback_data' => 'proced']
                	    ],
                	    [
                	        ['text' => 'Back', 'callback_data' => 'subscr']
                	    ]
                	]]
                );

            
            file_get_contents($botAPI . "/sendMessage?chat_id=$chat_id&text=$txt&reply_markup={$keyboard}"); 
        }
        //
        if($data === 'proced'){
            
           // Reply with callback_query data
            $nl = urlencode("\n");
            $txt = "Please click Proceed to payment button below to complete payment.".$nl;
            $txt .= "Once we receive payment you will be notified.";

            $chat_id = $update['callback_query']['from']['id'];
            
            $keyboard = json_encode(
                    ['inline_keyboard' => [
                	    [
                	        ['text' => 'Proceed to Payment', 'callback_data' => '1mont']
                	    ],
                	    [
                	        ['text' => 'Main Menu', 'callback_data' => 'mainme']
                	    ]
                	]]
                );

            
            file_get_contents($botAPI . "/sendMessage?chat_id=$chat_id&text=$txt&reply_markup={$keyboard}"); 
        }
        
        //Balance menu
        if($data === 'balan'){
            
           // Reply with callback_query data
            $nl = urlencode("\n");
            $txt = "Subscription Days Left: 0 ⏱".$nl;
            $txt .= "Your referral balance 💼".$nl;
            $txt .= "Bitcoin 💵 0.000000 BTC".$nl;
            $txt .= "Ethereum 💵 0.000000 ETH".$nl;
            $txt .= "Usdt | TRC 20 💵 0.000000 USDT";
            
            $chat_id = $update['callback_query']['from']['id'];
            
            $keyboard = json_encode(
                    ['inline_keyboard' => [
                	    [
                	        ['text' => 'Subscription', 'callback_data' => 'subscr']
                	    ],
                	    [
                	        ['text' => 'Main Menu', 'callback_data' => 'mainme']
                	    ]
                	]]
                );

            
            file_get_contents($botAPI . "/sendMessage?chat_id=$chat_id&text=$txt&reply_markup={$keyboard}"); 
        }
        
        //refer menu
        if($data === 'refer'){
            $nl = urlencode("\n");
            $txt = "💼 Your referral balance is:".$nl;
            $txt .= $nl;
            $txt .= "Bitcoin 💵 0.000000 BTC".$nl;
            $txt .= "Ethereum 💵 0.000000 ETH".$nl;
            $txt .= "Usdt | TRC 20 💵 0.000000 USDT".$nl;
            $txt .= $nl;
            $txt .= "All users: 0".$nl;
            $txt .= "- Active users: 0";
            
            $chat_id = $update['callback_query']['from']['id'];
            
            $keyboard = json_encode(
                    ['inline_keyboard' => [
                	    [
                	        ['text' => 'Referral Link', 'callback_data' => 'referlink']
                	    ],
                	    [
                	        ['text' => 'Withdraw', 'callback_data' => 'withref']
                	    ],
                	    [
                	        ['text' => 'Main Menu', 'callback_data' => 'mainme']
                	    ]
                	]]
                );

            
            file_get_contents($botAPI . "/sendMessage?chat_id=$chat_id&text=$txt&reply_markup={$keyboard}");
        }
        //
        if($data === 'referlink'){
            
            $chat_id = $update['callback_query']['from']['id'];
            $txt = "https://t.me/tst35bot?start=".$chat_id;
            
            $keyboard = json_encode(
                    ['inline_keyboard' => [
                	    [
                	        ['text' => 'Back', 'callback_data' => 'refer']
                	    ]
                	]]
                );

            
            file_get_contents($botAPI . "/sendMessage?chat_id=$chat_id&text=$txt&reply_markup={$keyboard}");
        }
        if($data === 'withref'){
            
            $nl = urlencode("\n");
            $txt = "💰 Your referral balance is:".$nl;
            $txt .= "Bitcoin 💵 0.000000 BTC".$nl;
            $txt .= "Ethereum 💵 0.000000 ETH".$nl;
            $txt .= "Usdt | TRC 20 💵 0.000000 USDT";
            
            $chat_id = $update['callback_query']['from']['id'];
            
            
            $keyboard = json_encode(
                    ['inline_keyboard' => [
                	    [
                	        ['text' => 'Bitcoin', 'show_alert' => 'Not Enough BTC on balance to Withdraw']
                	    ],
                	    [
                	        ['text' => 'Ethereum', 'show_alert' => 'Not Enough ETH on balance to Withdraw']
                	    ],
                	    [
                	        ['text' => 'Usdt | TRC20', 'show_alert' => 'Not Enough USDT(TRC20) on balance to Withdraw']
                	    ],
                	    [
                	        ['text' => 'Back', 'callback_data' => 'refer']
                	    ]
                	]]
                );

            
            file_get_contents($botAPI . "/sendMessage?chat_id=$chat_id&text=$txt&reply_markup={$keyboard}");
        }
        
        
        // main menu
        if($data === 'mainme'){
            $nl = urlencode("\n");
            $txt = "Hello This is a Test Telegram Bot, and here you can manage your subscription".$nl;
            $txt .= "- Choose and purchase any type of subscription".$nl;
            $txt .= "- See Statistics of your referrals and withdrawal earnings".$nl;
            $txt .= $nl;           
            
            $chat_id = $update['callback_query']['from']['id'];
            
            $keyboard = json_encode(
                            ['inline_keyboard' => [
                        	    [
                        	        [
                        	            'text' => 'Signals',
                        	            'callback_data' => 'signa'
                        	        ]
                        	    ],
                        	    [
                        	        [
                        	            'text' => 'Subscription',
                        	            'callback_data' => 'subscr'
                        	        ]
                        	    ],
                        	    [
                        	        [   
                        	            'text' => 'My Balance',
                        	            'callback_data' => 'balan'
                        	        ]
                        	    ],
                        	    [
                        	        [
                        	            'text' => 'My Referrals',
                        	            'callback_data' => 'refer'
                        	        ]
                        	    ],
                        	    [
                        	        [
                        	            'text' => 'Support',
                        	            'callback_data' => 'suppo'
                        	        ]
                        	    ]
                        	]]
                        );
    
            file_get_contents($botAPI . "/sendMessage?chat_id=$chat_id&text=$txt&reply_markup={$keyboard}");
        }
    }

    // Main Menu
    $msg = $update['message']['text'];
    if ($msg === "/start") {
        
        $nl = urlencode("\n");
        $txt = "Hello This is a Subcription, and here you can manage your subscription to our indicator:".$nl;
        $txt .= "- Choose and purchase any type of subscription".$nl;
        $txt .= "- See Statistics of your referrals and withdrawal earnings".$nl;        
        
        $chat_id = $update['message']['from']['id'];
        
        $keyboard = json_encode(
                        ['inline_keyboard' => [
                    	    [
                    	        [
                    	            'text' => 'Signals',
                    	            'callback_data' => 'signa'
                    	        ]
                    	    ],
                    	    [
                    	        [
                    	            'text' => 'Subscription',
                    	            'callback_data' => 'subscr'
                    	        ]
                    	    ],
                    	    [
                    	        [   
                    	            'text' => 'My Balance',
                    	            'callback_data' => 'balan'
                    	        ]
                    	    ],
                    	    [
                    	        [
                    	            'text' => 'My Referrals',
                    	            'callback_data' => 'refer'
                    	        ]
                    	    ],
                    	    [
                    	        [
                    	            'text' => 'Support',
                    	            'url' => 'https://t.me/DecryptDAO'
                    	        ]
                    	    ]
                    	]]
                    );

        // Send keyboard
        // $token/sendMessage?chat_id=$chat_id&text=$txt
        file_get_contents($botAPI . "/sendMessage?chat_id=$chat_id&text=$txt&reply_markup={$keyboard}");
    }

http_response_code(200);
