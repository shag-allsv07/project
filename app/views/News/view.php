<? if (!empty($new)): ?>
<div class="title">
    <h2><?=$new['title']?></h2>
</div>
<div class="row">
    <div class="date">Дата публикации: <?=$new['date']?></div>
    <img src="<?=$new['image']?>" alt="" />
    <p>
        <?=$new['description']?>
    </p>
</div>
<? else: ?>
<p>Такой новости не существует</p>
<? endif; ?>
