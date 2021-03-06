<?php include_partial('default/inner_head', array('show' => 3)) ?>

<div class='content_container help_container'>
    <h1 class='h_1'>Помощь</h1>
    <div class='help_text'> 
        <ol style='list-style: none'>
            <li>1. <a href="#1">Главные вопросы</a></li>
            <li>2. <a href="#2">Правила работы в системе</a></li>
            <li>
                3. <a href="#3">Описание работы системы</a>
                <ol style='list-style: none'>
                    <li>3.1. <a href="#3_1">Создание рекламы</a></li>
                    <li>3.2. <a href="#3_2">Пополнение баланса</a></li>
                    <li>3.3. <a href="#3_3">Размещение рекламы агентами</a></li>
                    <li>3.4. <a href="#3_4">Блокировка и удаление рекламы</a></li>
                    <li>3.5. <a href="#3_5">Учет кликов</a></li>
                </ol>
            </li>
            <li>4. <a href="#4">Словарь терминов</a></li>
        </ol>
    <div>

    <a name="1"></a>
    <h2 class='h_1'>1. Главные вопросы</h2>
    <a name="1_1"></a>
    <h3 class='h_1'>1.1. Как работает система AdRRIVA?</h3>

    <p>
        AdRRIVA &mdash; это система рекламы в социальной сети. 
        <br /><br />
        Реклама распространяется пользователями социальной сети с помощью кнопки "Нравится". Клик по этой кнопке, в интерфейсе AdRRIVA, приводит к размещению в ленте новостей пользователя рекламного объявления. Так же, это объявление увидят и все друзья пользователя. Так реклама распространяется по всей социальной сети. 
        <br /><br />
        Пользователям распространяющим рекламу (агентам) рекламодатели оплачивают все клики по объявлениям, которыми они делятся с друзьями.
        <br /><br />
        Благодаря уникальному пути распространения рекламы &mdash; лентам новостей в социальных сетях, реклама в AdRRIVA является для бизнеса одним из самых эффективных инструментов продвижения сайтов в социальной сети. Пользователи испытывают больше доверия к ссылкам, которые распространяют их друзья, благодаря чему вы получаете качественных посетителей, приходящих на ваш сайт за информацией о вашем продукте.
    </p>

    <a name="1_2"></a>
    <h3 class='h_1'>1.2. Как выглядят размещаемые в "Что нового" рекламные блоки?</h3>
    
    <p>
        Рекламные блоки (объявления) выглядят полностью аналогично обычным записям о "понравившихся ссылках":
    </p>
    <p>
        <?php print image_tag('../images/vk_share.png'); ?>
        <div class="text_header mt_10 gray_3">Рекламное объявление в социальной сети "В контакте"</div>
    </p>
    <p>
        <?php print image_tag('../images/fb_share.png'); ?>
        <div class="text_header mt_10 gray_3">Рекламное объявление в социальной сети "Facebook"</div>
    </p>
    <p>
        Таким образом, мы стараемся, чтобы рекламный контент AdRRIVA не раздражал друзей рекламных агентов.
    </p>

    <a name="1_3"></a>
    <h3 class='h_1'>1.3. Как создать объявление?</h3>

    <p>
        Вы пополняете свой бюджет, покупая внутренюю валюту &mdash; баллы.
        <br /><br />
        Далее вы должны создать рекламные блоки, которые будут вести на ваш сайт. Для этого на "Главной странице" кликните по кнопке "Создать рекламу". В появившемся окне вам нужно ввести описание своей ссылки: заголовок, сопровождающий текст и выбрать картинку. Так же вы должны указать цену за один клик по вашей рекламе в баллах.
        <br /><br />
        После сохранения рекламного блока, при условии ненулевого баланса, ваша реклама попадает в каталог. С помощью рекламного каталога агенты выбирают рекламу и делятся ссылками на нее со своими друзьями, которые в будущем могут стать посетителями вашего сайта.
    </p>

    <a name="1_4"></a>
    <h3 class='h_1'>1.4. Как оплачиваются клики?</h3>
    <p>
        После того как агент распространил рекламу среди своих друзей, рекламодатель оплачивает все клики по ней. При создании объявления цена клика должна быть указана рекламодателем. Так же рекламодатель вправе менять цену клика. Однако, цена на рекламу, которую разместил агент, фиксируется в момент размещения рекламы в социальной сети. Например, если цена клика на момент размещения рекламы составляла 5 баллов, а в дальнейшем рекламодатель повысил ее до 10 баллов, то все клики по уже размещенной рекламе будут оценены в 5 баллов.
        <br /><br />
        Администрация AdRRIVA тщательно следит за действиями агентов в системе и фильтрует подозрительные клики. Клики признанные фальшивыми не оплачиваются.
        <br /><br />
        Рекламодатель платит за клики только уникальных посетителей. Уникальным считается посетитель, не кликавший по данной ссылке в течение 24 часов. 
    </p>

    <a name="1_5"></a>
    <h3 class='h_1'>1.5. Не раздражает ли реклама пользователей социальной сети?</h3>
    <p>
        Нет, реклама в AdRRIVA адаптирована для социальной сети и ничем не отличается от размещения обычной ссылки в ленте новостей. Кроме этого, нами введены специальные ограничения. Агенты не могут размещать у себя в ленте новостей более одной ссылки в 4 часа. При этом нельзя делиться одной и той же ссылкой чаще чем один раз в 24 часа.
        <br /><br />
        Эти ограничения введены специально, чтобы пользователи социальной сети не устали от рекламы и конверсия от объявления была стабильной высокой.
    </p>

    <a name="1_6"></a>
    <h3 class='h_1'>1.6. Как фильтруются фальшивые клики?</h3>
    <p>
        По правилам системы AdRRIVA запрещено использовать автоматизированное программное обеспечения для "накрутки" рекламы. Агентам запрещено излишне мотивировать друзей тем или иным способом кликать по ссылкам лишь с целью клика, например рассылать сообщения с ссылкой на рекламируемый сайт или размещать ссылки на сторонних сайтах.
        <br /><br />
        Нами разработана система фильтрации кликов, которая использует как автоматические, так и ручные способы оценки. Аккаунты агентов, нарушивших правила, немедленно блокируются.
        <br /><br />
        Мы стараемся обеспечить только честное привлечение посетителей на сайты рекламодателей для увеличения доходов наших клиентов.
    </p>

    <a name="1_7"></a>
    <h3 class='h_1'>1.7. Как можно оплатить рекламу?</h3>
    <p>
        Реклама оплачивается с помощью популярных электронных валют: WebMoney и Яндекс.Деньги. Для того, чтобы пополнить баланс необходимо на "Главной странице" кликнуть по кнопке "Пополнить", выбрать количество баллов, на которое вы хотите пополнить свой баланс (сумма автоматически будет показана в рублях) и валюту для оплаты. Процессингом платежа является компания "<a target='_blank' href="http://www.roboxchange.com">Робокс</a>".
        <br /><br />
    </p>

    <a name="1_7"></a>
    <h3 class='h_1'>1.8. Что требуется от моего сайта?</h3>
    <p>
        Для размещения рекламы в системе AdRRIVA, сайт должен удовлетворять <a href="#2">правилам размещения сайтов</a>. От вас не требуется вносить никаких технических изменений на свой сайт.
    </p>
    
    <a name="2"></a>
    <h2 class='h_1'>2. Правила работы в системе</h2>
    <p>
        При размещении рекламы в системе необходимо соблюдать следующие правила:
    </p>

        <ul>
            <li>К размещению рекламы принимаются сайты только на русском языке;</li>
            <li>Сайт должен соответствовать требованиям действующего законодательства;</li>
            <li>Сайт не должен содержать материалов националистического или экстремистского характера, материалов утверждающих неравенство людей по полу, расе, национальности, вероисповеданию или социальному статусу;</li>
            <li>Сайт не должен содержать оскорбительные или порнографические материалы;</li>
            <li>Не принимаются сайты распространяющие вирусы, трояны и вредоносное ПО; сайты маскирующиеся под другие сайты (фишинговые сайты) и вводящие пользователя в заблуждение;</li>
            <li>Администрация AdRRIVA имеет право отклонить и удалить рекламу сайтов по собственному усмотрению без объяснения причин;</li>
        </ul>

    <p>
        В случае выявления нарушений правил системы, AdRRIVA оставляет за собой право на расторжение договора об оказании услуг и полную блокировку аккаунта пользователя, нарушившего правила. 
    </p>

    <a name="3"></a>
    <h2 class='h_1'>3. Описание работы системы</h2>

    <a name="3_1"></a>
    <h3 class='h_1'>3.1. Создание рекламы</h3>

    <p>
        Для создания рекламы, на "Главной странице" кликните по кнопке "Создать рекламу" и в появившемся окне заполните информацию о вашей странице. Для этого нужно ввести заголовок, описание и выбрать картинку. Так же необходимо указать цену за клик по рекламному объявлению в баллах (это внутренняя валюта системы) и указать категорию объявления, чтобы агентам было проще найти вашу рекламу в каталоге рекламы.
        <br /><br />
        После сохранения объявления, если ваш баланс не был равен нулю, ваш рекламный блок сразу появиться в каталоге рекламы и будет доступен для распространения агентами.
        <br /><br />
        Созданная вами реклама будет отображаться в блоке "Моя реклама" на "Главной странице".
    </p>

    <a name="3_2"></a>
    <h3 class='h_1'>3.2. Пополнение баланса</h3>
    <p>
        Чтобы пополнить баланс, на "Главной странице" кликните по кнопке "Пополнить". Появится диалог, в котором нужно ввести сумму в баллах на которую вы хотите пополнить свой баланс. Введенная вами сумма в балах будет автоматически пересчитана в рубли. 
        <br /><br />
        Далее вам нужно выбрать платежную систему с помощью которой вы хотите пополнить баланс. На текущий момент доступно пополнение в валюте Яндекс.Деньги и WebMoney.
        <br /><br />
        После пополнения баланса вся реклама, находящаяся в статусе "Заблокировано из-за отсутствия средств" будет переведена в активный статус и будет доступна для агентов системы.
        <br /><br />
    </p>

    <a name="3_3"></a>
    <h3 class='h_1'>3.3. Размещение рекламы агентами</h3>
    <p>
        Ваша реклама, при условии ненулевого баланса, доступна для агентов в каталоге рекламы. Агенты добавляют рекламу из каталога на свою страницу и могут делиться вашим объявлением со своими друзьями. Для этого используется кнопка "Нравится", которая предоставляет интерфейс для публикации ссылок в ленты новостей пользователей (эту кнопку предоставляет сама социальная сеть).
        <br /><br />
        Клик по кнопке "Нравится" в интерфейсе агента приводит к тому, что в его новостной ленте в социальной сети появляется запись о том, что он поделился ссылкой на ваш сайт. Это же сообщение увидят все его друзья. Они могут перейти на ваш сайт просто кликнув по рекламной ссылке в своей ленте новостей в социальной сети. Этот клик будет оплачен из вашего баланса.
    </p>

    <a name="3_4"></a>
    <h3 class='h_1'>3.4. Блокировка и удаление рекламы.</h3>
    <p>
        Вы можете временно приостановить распространение рекламы агентами. Для этого на "Главной странице" под рекламным блоком кликните по ссылке "Заблокировать". Объявление будет переведено в статус "Заблокированно". 
        <br /><br />
        В этом случае агенты не смогут делиться ссылками на ваш сайт, ваше объявление пропадет из каталога, а все ссылки из социальной сети будут перенаправлены на сайт AdRRIVA. Для разблокировки объявления кликните по ссылке "Разблокировать" &mdash; объявление будет восстановлено.
        <br /><br />
        Если ваш баланс будет меньше чем минимальная цена ваших рекламных блоков, то вся блоки будут заблокированны. В данном случае реклама будет вести себя аналогично заблокированному статусу. После пополнения баланса вся реклама перейдет в активный статус.
        <br /><br />
        Агент может удалить рекламу, которой он делился, из своего интерфейса в системе AdRRIVA. Это означает приостановку работы всех ссылок, которыми он делился &mdash; все они автоматически будут перенаправлены на сайт AdRRIVA.
        <br /><br />
        Администрация AdRRIVA оставляет за собой право на удаление и блокировку любой рекламы, которая не отвечает правилам размещения рекламы в системе.
    </p>

    <a name="3_5"></a>
    <h3 class='h_1'>3.5. Учет кликов</h3>
    <p>
        Цена за клик назначается вами и остается фиксированной с момента запуска агентом рекламного блока. Таким образом, если вы измените цену клика с момента, когда агент поделился рекламой, то цена за клики по размещенным объявлениям будет фиксирована на момент запуска рекламы.
        <br /><br />
        Администрация AdRRIVA имеет право проверки всех кликов по объявлениям. Оплачиваются только клики уникальных пользователей. Им считается пользователь не кликавший по данной рекламе за последние 24 часа. Не учитываются клики от одного пользователя, сделанные чаще чем один раз в 20 секунд. 
        <br /><br />
        Деньги за учтенные клики будут списаны с вашего баланса. AdRRIVA берет комиссию с каждого клика, поэтому к цене клика прибавляется комиссия системы. На текущий момент она составляет 0%. В случае получения дробного числа баллов, комиссия округляется до большего целого числа.
    </p>

    <a name="4"></a>
    <h2 class='h_1'>4. Словарь терминов</h2>
    <ul>
        <li>Рекламный блок (объявление) &mdash; краткое описание рекламируемого сайта, включающее в себя заголовок, описание и ссылку на сайт, а так же картинку. Блок предназначен для помещения в социальную сеть, как событие размещения ссылки.</li>
        <li>Агент &mdash; пользователь социальной сети, зарегистрировавшийся в AdRRIVA как агент, с целью размещения в своей ленте новостей рекламных блоков для заработка денег за клики по рекламному блоку.</li>
        <li>Рекламодатель &mdash; пользователь социальной сети, зарегистрировавшийся в AdRRIVA как рекламодатель, с целью распространения своих рекламных блоков.</li>
    </ul>

</div>

