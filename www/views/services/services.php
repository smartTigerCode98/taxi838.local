



<link href = "../../webroot/css/services/services.css" rel = "stylesheet" type = "text/css"/>


<h2 id="title_services">Послуги</h2>
    <div class="container" style="margin-top: -7px;">
        <div class="row">
            <div class="coll-offset-lg-1 coll-lg-10 coll-offset-md-1 coll-md-10 coll-offset-sm-1 coll-sm-10 coll-exs-10">
                <?php foreach ($data['services'] as $service): ?>
                <div class="block_service">
                    <a class="image_service" href="/services/information/<?=$service->id?>">
                        <img src="../../webroot/img/services/<?=$service->image?>" class="image">
                    </a>
                    <p class="title"><?=$service->title?></p>
                    <p class="summary"><?=$service->summary?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<div class="pstrnav">
    <?=$data['pagination']?>
</div>


