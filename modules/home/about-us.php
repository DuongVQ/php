<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

$data = [
    'pageTitle' => 'Về chúng tôi'
];

layouts('header', $data);

?>
<div class="position-relative overflow-hidden p-3 p-md-5 text-center bg-body-tertiary">
    <div class="col-md-6 p-lg-5 mx-auto my-5">
        <h1 class="display-3 fw-bold">Designed for engineers</h1>
        <h3 class="fw-normal text-muted mb-3">Build anything you want with Aperture</h3>
        <div class="d-flex gap-3 justify-content-center lead fw-normal">
            <a class="icon-link" href="#">
                Learn more
                <svg class="bi">
                    <use xlink:href="#chevron-right"></use>
                </svg>
            </a>
            <a class="icon-link" href="#">
                Buy
                <svg class="bi">
                    <use xlink:href="#chevron-right"></use>
                </svg>
            </a>
        </div>
    </div>
</div>
<?php
layouts('footer');
?>