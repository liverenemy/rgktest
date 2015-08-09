<?php
/**
 * @var integer $timestamp
 */

$dt = new DateTime();
$dt->setTimestamp($timestamp);
$now = new DateTime();
$oneWeek = new DateInterval('P1W');
$oneWeekAgo = $now->sub($oneWeek);
$formatter = Yii::$app->formatter;
?>
<? if ($dt <= $oneWeekAgo) : ?>
    <?= $formatter->asDate($timestamp); ?>
<? else: ?>
    <span class="dotted" title="<?= $formatter->asDatetime($timestamp) ?>">
        <?= $formatter->asRelativeTime($timestamp) ?>
    </span>
<? endif ?>