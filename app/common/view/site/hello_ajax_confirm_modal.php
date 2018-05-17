<?php
$response = 
[
    'document_page__modal_title'=>[
        'html'=>'<b>Hello Curiosity!</b>',
    ],
    'document_page__header'=>['class'=>'modal-header alert alert-danger'],
    'document_page__modal_body'=>[
        'html'=>'To download the document, click [Confirm]. <br /><br />This is your sample modal message. you can click [x] or [Cancel] to close or somewhere outside this modal. 
    To play around with my Title and Message, you can edit my content at '. __FILE__],    
    'document_page__confirm'=>['html'=>'Confirm','href'=>'https://www.programmingstacks.com'],
];
echo json_encode($response);