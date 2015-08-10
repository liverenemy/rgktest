<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Тестовое задание</h1>

        <p class="lead">Соискатель - Сергей Черданцев</p>

        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['book/index']) ?>">Тестовое задание</a></p>
        <p>
            <a href="http://novokuznetsk.hh.ru/applicant/resumes/view?resume=ed4746c0ff022ea8fb0039ed1f617a32585a6e"
               target="_blank">
                Резюме соискателя
            </a>
        </p>
    </div>

    <div class="body-content">

        <div class="row">
            <h2>Постановка задачи</h2>
            <p>Сделать на Yii2 возможность только зарегистрированным пользователям просматривать,
                удалять, редактировать записи в таблице "books":<br>
                |books|<br>
                id,<br>
                name,<br>
                date_create, / дата создания записи<br>
                date_update, / дата обновления записи<br>
                preview, / путь к картинке превью книги<br>
                date, / дата выхода книги<br>
                author_id / ид автора в таблице авторы<br>
                <br>
                |authors| редактирование таблицы авторов не нужно, необходимо ее просто заполнить тестовыми данными.<br>
                id,<br>
                firstname, / имя автора<br>
                lastname,  / фамилия автора<br>

                в итоге страница управления книгами должна выглядеть так:
            </p>
            <p>
                <img src="/upload/images/testTask.png">
            </p>
<!--            <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>-->
<!--            <div class="col-lg-4">-->
<!--            </div>-->
<!--            <div class="col-lg-4">-->
<!--                <h2>Heading</h2>-->
<!---->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et-->
<!--                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu-->
<!--                    fugiat nulla pariatur.</p>-->
<!---->
<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>-->
<!--            </div>-->
<!--            <div class="col-lg-4">-->
<!--                <h2>Heading</h2>-->
<!---->
<!--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et-->
<!--                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip-->
<!--                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu-->
<!--                    fugiat nulla pariatur.</p>-->
<!---->
<!--                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>-->
<!--            </div>-->
        </div>
        <div class="col-lg-4">
            <p><a class="btn btn-default" href="<?= Url::to(['site/signup']) ?>">Зарегистрироваться &raquo;</a></p>
        </div>
        <div class="col-lg-4">
            <p><a class="btn btn-default" href="<?= Url::to(['site/login']) ?>">Войти на сайт &raquo;</a></p>
        </div>
        <div class="col-lg-4">
            <p><a class="btn btn-default" href="<?= Url::to(['book/index']) ?>">Просмотреть результат &raquo;</a></p>
        </div>

    </div>
</div>
