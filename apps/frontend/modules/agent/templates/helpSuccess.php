<?php include_partial('default/inner_head', array('show' => 4)) ?>

<div class='content_container help_container'>
    <h1 class='h_1'>Помощь</h1>
    <div class='help_text'> 
        <ol style='list-style: none'>
            <li>1. <a href="#1">Главные вопросы</a></li>
            <li>2. <a href="#2">Правила работы в системе</a></li>
            <li>3. <a href="#3">Описание работы системы</a>
                <ol style='list-style: none'>
                    <li>3.1. <a href="#3_1">Добавление рекламы</a></li>
                    <li>3.2. <a href="#3_2">Запуск рекламы</a></li>
                    <li>3.3. <a href="#3_3">Ограничения на размещение рекламы</a></li>
                    <li>3.4. <a href="#3_4">Удаление рекламы</a></li>
                    <li>3.5. <a href="#3_5">Остановка рекламы рекламодателем</a></li>
                    <li>3.6. <a href="#3_6">Учет кликов</a></li>
                    <li>3.7. <a href="#3_7">Выплаты</a></li>
                </ol>
            </li>
            <li>4. <a href="#4">Словарь терминов</a></li>
        </ol>
        <div>
            <a name="1"></a>
            <h2>1. Главные вопросы</h2>
            <a name="1_1"></a>
            <h3>1.1. Как работает система AdRRIVA?</h3>
            <p>
                AdRRIVA &mdash; это система рекламы в социальных сетях. 
                <br /><br />
                Реклама распространяется пользователями социальной сети с помощью кнопки "Нравится". Клик по этой кнопке в интерфейсе AdRRIVA приводит к размещению рекламного объявления в новостной ленте, так оно становится доступно всем друзьям пользователя. 
                <br /><br />
                Пользователям, распространяющим рекламу, оплачиваются все клики по рекламным блокам, которыми они делятся с друзьями. 
            </p>

            <a name="1_2"></a>
            <h3>1.2. Как выглядят рекламные блоки?</h3>
            <p>
                Рекламные блоки выглядят полностью аналогично обычным записям о "понравившихся ссылках":
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
                Таким образом, мы стараемся, чтобы рекламный контент AdRRIVA не раздражал друзей рекламных агентов и пользователей социальной сети.
            </p>

            <a name="1_3"></a>
            <h3>1.3. Как разместить объявление?</h3>
            <p>
                На "Главной странице" необходимо нажать на кнопку "Добавить рекламу" и выбрать понравившийся рекламный блок. После этого необходимо нажать на кнопку "Запустить", напротив выранного объявления в списке "Моя реклама", выбрать социальную сеть для запуска, и в появившемся окне нажать на кнопку "Нравится". Для каждой социальной сети в окошке указана подсказка, как правильно запустить рекламу.
                <br /><br />
                После этого рекламный блок появится в вашей ленте новостей и в лентах ваших друзей. Так реклама распространяется по социальной сети.
            </p>

            <a name="1_4"></a>
            <h3>1.4. За что я получу деньги?</h3>
            <p>
                Агенты (пользователи, которые распространяют рекламу) получают деньги за каждый клик по рекламным объявлениям, которыми они делятся с друзьями в социальной сети. Цену за один клик назначает рекламодатель, она показывается в "Каталоге рекламы" напротив объявления. Таким образом, вы можете выбрать интересную для ваших друзей рекламу, по привлекательной цене. 
            </p>

            <a name="1_5"></a>
            <h3>1.5. Не будет ли реклама надоедать моим друзьям?</h3>
            <p>
                Нет, реклама в AdRRIVA адаптирована для пользователей социальной сети и ничем не отличается от размещения обычной ссылки в ленте новостей. Кроме этого, нами введены специальные ограничения. Агенты не могут размещать у себя в "Что нового" более одной ссылки в 4 часа. При этом нельзя делиться одной и той же ссылкой чаще, чем раз в 24 часа.
                <br /><br />
                Эти ограничения введены специально, чтобы ваши друзья не устали от рекламы и конверсия от размещения рекламы была стабильно высокой. Высокая конверсия гарантирует и ваш высокий заработок в системе.
            </p>

            <a name="1_6"></a>
            <h3>1.6. Можно ли кликать самому по своим объявлениям или специально подговаривать друзей кликать по рекламе?</h3>
            <p>
                AdRRIVA серьезно относится к проблеме безопасности размещаемой рекламы. Мы тщательно следим, чтобы все клики были сделаны настоящими людьми. Для этого используются автоматические и ручные фильтры кликов. 
                <br /><br />
                В <a href="#2">правилах размещения рекламы</a> запрещается использовать в качестве комментария к рекламе слишком явные призывы делать клики по объявлению. 
                <br /><br />
                В случае нарушения правил размещения рекламы, AdRRIVA вправе отказаться от услуг агента и/или немедленно расторгнуть с ним отношения. Услуги с момента последней выплаты, для агента нарушившего правила, считаются недействительными и не оплачиваются.
            </p>

            <a name="1_7"></a>
            <h3>1.7. Как получить выплаты от AdRRIVA?</h3>
            <p>
                Выплаты агентам, за все учтенные за отчетный период клики, осуществляются два раза в месяц. 
                <br /><br />
                Агент, после набора предельной суммы, может подать заявку на вывод средств в системе. После подачи заявки, с его аккаунта списывается указанная им в заявке сумма в баллах. В ближайшую дату выплат деньги поступят на счет агента.
                <br /><br />
                Выплаты осуществляет компания Robox, деньги приходят на указанный агентом в заявке счет в электронной валюте. На данный момент поддерживаются выплаты в WebMoney, Яндекс.Деньгах, Деньги@Mail.Ru. 
                <br /><br />
                В будущем можно будет выводить деньги на счет мобильного телефона и в другие платежные системы.
            </p>
            
            <a name="2"></a>
            <h2>2. Правила работы в системе</h2>
            <p>
                При работе в системе AdRRIVA необходимо соблюдать следующие правила:
                <ul>
                    <li>Запрещено излишне мотивировать кликать пользователей по объявлениям. Оставлять комментарии к рекламному блоку содержащие явный призыв к клику. При этом можно оставлять комментарий к объявлению, комментирующий содержимое сайта;</li>
                    <li>Запрещается размещать объявления чаще, чем один раз в час;</li>
                    <li>Запрещается размещать объявления в одной социальной сети чаще, чем один раз в 4 часа;</li>
                    <li>Запрещается размещать одно и то же объявление чаще, чем один раз в 24 часа;</li>
                    <li>Запрещается размещать ссылки AdRRIVA из рекламных объявлений на сторонних сайтах;</li>
                    <li>Запрещается использование сторонних каналов распространения ссылок (сообщения в социальной сети и пр.), кроме тех, что предусмотрены интерфейсами AdRRIVA;</li>
                    <li>Запрещается использовать систему для аккаунтов не являющихся реальными людьми;</li>
                    <li>Любые попытки использования системы для массового спама будут пресекаться, информация об организаторах спам рассылок будет передаваться в службу безопасности социальной сети;</li>
                    <li>Запрещено скликивание объявлений с помощью автоматизированных средств;</li>
                </ul>
                В случае выявления нарушений правил системы, AdRRIVA оставляет за собой право на расторжение договора об оказании услуг и полную блокировку аккаунта пользователя, нарушившего правила. В данном случае оплата услуг агента с момента последнего платежа не производится.
            </p>

            <a name="3"></a>
            <h2>3. Описание работы системы</h2>

            <a name="3_1"></a>
            <h3>3.1. Добавление рекламы</h3>
            <p>
                Рекламодатели размещают свои объявления в каталоге рекламы AdRRIVA. В каталог попадают объявления только от тех рекламодателей, баланс которых выше нуля. 
                <br /><br />
                Для добавления рекламы необходимо на "Главной странице" щелкнуть по кнопке "Добавить рекламу" или по ссылке в верхнем меню "Каталог рекламы". В каталоге по умолчанию выводятся все рекламные блоки, отсортированные по дате добавления. Так же доступна сортировка по популярности (количеству агентов, использующих данную рекламу) и цене за один клик. Каталог можно просматривать по категориям рекламы - для этого выберите режим просмотра "Категории".
                <br /><br />
                Мы рекомендуем вам искать рекламу, соответствующую интересам ваших друзей. Это обеспечивает наиболее высокую конверсию и доход от рекламы.
                <br /><br />
                Для добавления объявления щелкните по кнопке "Добавить" напротив объявления в каталоге.
            </p>

            <a name="3_2"></a>
            <h3>3.2. Запуск рекламы</h3>
            <p>
                Для запуска рекламы на "Главной странице" щелкните по кнопке "Запустить" напротив рекламного блока. Выберите социальную сеть для запуска и следуйте подсказкам. Вы увидите окно с кнопкой социальной сети "Нравится" - для размещения рекламы нажмите на нее (соблюдайте подсказки). Внимание: комментарий к рекламной ссылке не должен нарушать <a href="#2">правил системы AdRRIVA</a>. Желательно, чтобы комментарий содержал описание сайта, но не был призывом просто кликать по рекламному блоку.
                <br /><br />
                После этого в вашей ленте новостей появится рекламное объявление, выглядящее как событие о том, что вы поделились ссылкой. С этого момента все клики уникальных пользователей по этой ссылке будут засчитываться на ваш аккаунт.
            </p>

            <a name="3_3"></a>
            <h3>3.3. Ограничения на размещение рекламы</h3>
            <p>
                В системе AdRRIVA введено ограничение на размещение ссылок: агент не может запускать рекламу чаще, чем один раз в час и один раз в 4 часа в одной и той же социальной сети. Так же нельзя запускать рекламу одного и того же рекламного блока чаще одного раза в 24 часа. Поэтому мы советуем, при добавлении рекламы, выбирать сразу несколько рекламных блоков. 
                <br /><br />
                После запуска рекламы, на "Главной странице" кнопка "Запустить", напротив рекламного блока, пропадает и выводиться уведомление через какое время можно будет повторно запустить рекламу.
            </p>

            <a name="3_4"></a>
            <h3>3.4. Удаление рекламы</h3>
            <p>
                Если вы решите удалить выбранную ранее рекламу из списка "Моя реклама", то все ссылки из рекламных блоков, которыми вы поделились, будут вести на сайт AdRRIVA. Клики по данным объявлениям не будут учтены и деньги за них выплачиваться не будут.
                <br /><br />
                Мы рекомендуем вам удалять рекламу только в случае крайней необходимости: например, если вы считаете, что рекламный блок не принесет вам больше никакого дохода, вы его не будете запускать в дальнейшем и клики по нему прекратились.
            </p>

            <a name="3_5"></a>
            <h3>3.5. Остановка рекламы рекламодателем</h3>
            <p>
                Рекламодатель вправе самостоятельно заблокировать или удалить рекламный блок. Так же рекламный блок может быть заблокирован в связи с отсутствием средств на балансе рекламодателя.
                <br /><br />
                В случае если рекламодатель временно заблокировал свой рекламный блок, в списке "Моя реклама" на "Главной странице" вы увидите предупреждение о том, что реклама временно приостановлена. Ссылки с рекламных блоков, размещенных в ленте новостей, будут вести на сайт AdRRIVA.
                <br /><br />
                Если рекламодатель удалит рекламное объявление, то оно автоматически пропадет из вашего списка "Моя реклама". Ссылки с рекламных блоков, размещенных в ленте новостей будут вести в AdRRIVA.
                <br /><br />
                При временной блокировке объявления, в связи с отсутствием средств на балансе рекламодателя, в списке "Моя реклама" будет выведено предупреждение, что реклама временно приостановлена. Ссылки с рекламных блоков, размещенных в ленте новостей будут вести на сайт AdRRIVA.
            </p>

            <a name="3_6"></a>
            <h3>3.6. Учет кликов</h3>
            <p>
                Цена за клик назначается рекламодателем и остается фиксированной с момента запуска вами рекламного блока. Таким образом, если рекламодатель изменит цену клика с момента запуска вами его рекламного блока, то цена за клики по уже размещенным объявлениям будет фиксирована на момент запуска рекламы.
                <br /><br />
                Администрация AdRRIVA оставляет за собой право полной проверки всех кликов по объявлениям. Оплачиваются только клики уникальных пользователей, сделавших клик по конкретному рекламному блоку. Уникальным посетителем считается пользователь не кликавший по данной рекламе за последние 24 часа. Не учитываются клики от одного пользователя, сделанные чаще чем один раз в 20 секунд. 
                <br /><br />
                Администрация AdRRIVA имеет право не признать действительность тех или иных кликов и отказать в их оплате.
            </p>

            <a name="3_7"></a>
            <h3>3.7. Выплаты</h3>
            <p>
                При достижении порогового значения, вы можете подать заявку на вывод средств. В этом случае, кнопка "Вывести" на "Главной странице" изменит цвет на оранжевый. Вы можете выводить деньги на свой счет в электронной валюте Деньги@Mail.Ru, WebMoney и Яндекс.Деньги. В скором времени появится возможность выводить деньги в других электронных валютах, а также зачислять деньги на баланс мобильного телефона.
                <br /><br />
                Выплатами платежей занимается компания Robox, администрация AdRRIVA не несет ответственности за действия компании Robobx и осуществление денежных выплат. Однако в случае спорных ситуаций, администрация AdRRIVA может санкционировать запрос в Robox на проверку корректности перевода денежных средств на счет агента.
                <br /><br />
                Выплаты осуществляются 2 раза в месяц, обычно это начало или середина месяца.
            </p>

            <a name="4"></a>
            <h2>4. Словарь терминов</h2>
            <ul>
                <li>Рекламный блок (объявление) - краткое описание рекламируемого сайта, включающее в себя заголовок, описание и ссылку на сайт, а так же картинку. Блок предназначен для помещения в социальную сеть, как событие размещения ссылки.</li>
                <li>Агент - пользователь социальной сети, зарегистрировавшийся в AdRRIVA как агент, с целью размещения в своей ленте новостей рекламных блоков для заработка денег за клики по рекламному блоку.</li>
                <li>Рекламодатель - пользователь социальной сети, зарегистрировавшийся в AdRRIVA как рекламодатель, с целью распространения своих рекламных блоков.</li>
            </ul>
        </div>
    </div>
</div>
