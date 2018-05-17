<?php
$response = 
[
    'forum_modal_title'=>'<b>Hello Curiosity!</b>',
    'forum_modal_body'=>'This is your sample modal message. you can click [x] or [OK] to close or somewhere outside this modal. 
    To play around with my Title and Message, you can edit my content at '. __FILE__,
];
echo json_encode($response);