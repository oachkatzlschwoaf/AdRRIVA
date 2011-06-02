Currency; Account; Sum; Comment<br />
<?php foreach ($funds as $fund): ?>
<?php print sfConfig::get('app_emoney_robox_'.$fund->getCurrency()); ?>;<?php print $fund->getEmoneyId(); ?>;<?php print floor($fund->getMoney() / 100); ?>;AdRRIVA-<?php print $fund->getId(); ?><br />
<?php endforeach; ?>
