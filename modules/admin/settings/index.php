<?php

$brouse		 = '';
$lsize		 = '';
$template	 = "admin/admin";
$mod_name	 = 'Управление настройками сайта';

$context = '<div class="row">';

$context .= '<div class="col-md-6 col-lg-3">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                            <a class="nav-link" href="' . WWW_ADMIN_PATH . 'settings/lang">
                                <h1 class="font-light text-white"><i class="mdi mdi-google-translate"></i></h1>
                                <h6 class="text-white">Управление языками</h6></a>
                            </div>
                        </div>
                    </div>';
$context .= '<div class="col-md-6 col-lg-3">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                            <a class="nav-link" href="' . WWW_ADMIN_PATH . 'settings/translation">
                                <h1 class="font-light text-white"><i class="mdi mdi-translate"></i></h1>
                                <h6 class="text-white">Управление переводами</h6></a>
                            </div>
                        </div>
                    </div>';
$context .= '<div class="col-md-6 col-lg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                            <a class="nav-link" href="' . WWW_ADMIN_PATH . 'settings/misto">
                                <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                                <h6 class="text-white">Города</h6></a>
                            </div>
                        </div>
                    </div>';
$context .= '<div class="col-md-6 col-lg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                            <a class="nav-link" href="' . WWW_ADMIN_PATH . 'settings/seo">
                                <h1 class="font-light text-white"><i class="mdi mdi-seal"></i></h1>
                                <h6 class="text-white">SEO</h6></a>
                            </div>
                        </div>
                    </div>';
$context .= '<div class="col-md-6 col-lg-3">
                        <div class="card card-hover">
                            <div class="box bg-purple text-center">
                            <a class="nav-link" href="' . WWW_ADMIN_PATH . 'settings/gradients">
                                <h1 class="font-light text-white"><i class="mdi mdi-gradient"></i></h1>
                                <h6 class="text-white">Градиенты</h6></a>
                            </div>
                        </div>
                    </div>';
$context .= '<div class="col-md-6 col-lg-3">
                        <div class="card card-hover">
                            <div class="box bg-info text-center">
                            <a class="nav-link" href="' . WWW_ADMIN_PATH . 'users">
                                <h1 class="font-light text-white"><i class="mdi mdi-account-card-details"></i></h1>
                                <h6 class="text-white">Пользователи</h6></a>
                            </div>
                        </div>
                    </div>';
$context .= '<div class="col-md-6 col-lg-3">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                            <a class="nav-link" href="' . WWW_ADMIN_PATH . 'settings/telegram">
                                <h1 class="font-light text-white"><i class="mdi mdi-telegram"></i></h1>
                                <h6 class="text-white">Телеграмм</h6></a>
                            </div>
                        </div>
                    </div>';
$context .= '<div class="col-md-6 col-lg-3">
                        <div class="card card-hover">
                            <div class="box alert-success text-center">
                            <a class="nav-link" href="' . WWW_ADMIN_PATH . 'stblocck">
                                <h1 class="font-light text-dark"><i class="mdi mdi-block-helper"></i></h1>
                                <h6 class="text-dark">Статические блоки</h6></a>
                            </div>
                        </div>
                    </div>';
$context .= '</div>';

include TEMPLATE_DIR . DS . $template . ".html";
