<?php
require __DIR__ .'/app/bootstrap.php';


$app->get('/', function() use ($app) {
    $data = [];
    $handle = opendir(AUDIO);
    while( false !== ($name = readdir($handle)) ) {
        if( false === is_file(AUDIO.$name) )
            continue;
        list($eng, $rus, $ext) = explode(
            "~", 
            mb_convert_encoding(
                $name, 
                'UTF-8', 
                'Windows-1251'
            )
        );
        $data[$eng] = ['text'=>$rus, 'url'=>$rus];
    }
    closedir($handle);
    $app->render('page.twig', ['data'=>$data]);
});

$app->post('/upload', function() use ($app) {
	$eng = trim($_POST['eng']);
	$rus = trim($_POST['rus']);
    if( count($_FILES['audio']) > 0 && 
        $rus !== '' && 
        $eng !== ''
    ){
        $filename = mb_convert_encoding(
            $eng.'~'.$rus.'~.mp3', 
            'Windows-1251',
            'UTF-8'
        );
        $handle = opendir(AUDIO);
        while( false !== ($name = readdir($handle)) ) {
            if( $name === $filename ) {
                closedir($handle);
                $app->redirect('/');
            }
        }
        closedir($handle);
        move_uploaded_file($_FILES['audio']['tmp_name'], AUDIO.$filename);
    }
    
    $app->redirect('/');
});

$app->run();