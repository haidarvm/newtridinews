<?php
// header('Content-type: image/jpeg');
// $builder->build();
$_SESSION['phrase'] = $builder->getPhrase();
echo $_SESSION['phrase'];
?>

<img src="<?php echo $builder->inline(); ?>" />