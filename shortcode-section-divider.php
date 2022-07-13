<?php 
  if ($style == 'inverted') {
    $code = 'M500,48.4C205,48.5,0,0,0,0v50h1000V0C1000,0,795,48.3,500,48.4z';
    $inverted = ' inverted';
  } else {
    $code = 'M1000,0c0,0-204.95,49.93-500,50S0,0,0,0';
    $inverted = '';
  }
  $rotated = $rotate=='yes' ? 'rotated' : '';
?>

<div class="divider-curved<?php echo $inverted.' '.$rotated ?>">

  <svg
    version="1.1"
    xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    x="0px" y="0px"
    viewBox="0 0 1000 50"
    preserveAspectRatio="none"
    style="
      width:100%;
      height:<?php echo $height; ?>;
    "
  >
    <path class="fill-<?php echo $colour; ?>" d="<?php echo $code; ?>"/>
  </svg>

</div>
