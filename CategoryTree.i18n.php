<?php
/**
 * Internationalisation file for extension CategoryTree.
 *
 * @addtogroup Extensions
 * @author Daniel Kinzler, brightbyte.de
 * @copyright © 2006-2008 Daniel Kinzler
 * @license GNU General Public Licence 2.0 or later
 */

$messages = array();

/** English
 * @author Daniel Kinzler, brightbyte.de
 */
$messages['en'] = array(
	'categorytree'                  => 'CategoryTree',
	'categorytree-tab'              => 'Tree',
	'categorytree-legend'           => 'Show category tree',
	'categorytree-desc'             => 'AJAX based gadget to display the [[Special:CategoryTree|category structure]] of a wiki',
	'categorytree-header'           => 'Enter a category name to see its contents as a tree structure.
Note that this requires advanced JavaScript functionality known as AJAX.
If you have a very old browser, or have JavaScript disabled, it will not work.',

	'categorytree-category'         => 'Category:',
	'categorytree-go'               => 'Show Tree',
	'categorytree-parents'          => 'Parents',

	'categorytree-mode-categories'  => 'categories only',
	'categorytree-mode-pages'       => 'pages except images',
	'categorytree-mode-all'         => 'all pages',

	'categorytree-collapse'         => 'collapse',
	'categorytree-expand'           => 'expand',
	'categorytree-load'             => 'load',
	'categorytree-loading'          => 'loading…',
	'categorytree-nothing-found'    => 'nothing found',
	'categorytree-no-subcategories' => 'no subcategories',
	'categorytree-no-pages'         => 'no pages or subcategories',
	'categorytree-not-found'        => 'Category <i>$1</i> not found',
	'categorytree-error'            => 'Problem loading data.',
	'categorytree-retry'            => 'Please wait a moment and try again.',

	'categorytree-show-list'        => 'Show as list',
	'categorytree-show-tree'        => 'Show as tree',
	'categorytree-too-many-subcats' => "Cannot show subcategories as a tree, there are too many of them.",
);

/** Afrikaans (Afrikaans)
 * @author Arnobarnard
 * @author SPQRobin
 */
$messages['af'] = array(
	'categorytree'                  => 'Kategorieboom',
	'categorytree-tab'              => 'Boom',
	'categorytree-legend'           => 'Wys kategorieboom',
	'categorytree-header'           => "Tik 'n kategorienaam om sy inhoud as 'n boomstruktuur te sien. Hierdie benodig gevorderde JavaScript-funksionaliteit bekend as AJAX. Met 'n baie ou blaaier, of as JavaScript gedeaktiveer is, sal dit nie werk nie.",
	'categorytree-category'         => 'Kategorie:',
	'categorytree-go'               => 'Wys boom',
	'categorytree-parents'          => 'ouers',
	'categorytree-mode-categories'  => 'slegs kategorieë',
	'categorytree-mode-pages'       => 'bladsye met prentbladsye uitgesluit',
	'categorytree-mode-all'         => 'alle bladsye',
	'categorytree-collapse'         => 'vou toe',
	'categorytree-expand'           => 'vou oop',
	'categorytree-load'             => 'laai',
	'categorytree-loading'          => 'laai tans',
	'categorytree-nothing-found'    => 'niks gevind nie',
	'categorytree-no-subcategories' => 'geen subkategorieë nie',
	'categorytree-no-pages'         => 'geen bladsye of subkategorieë nie',
	'categorytree-not-found'        => 'Kategorie <i>$1</i> nie gevind nie',
	'categorytree-show-list'        => 'Wys as lys',
	'categorytree-show-tree'        => 'Wys as boom',
	'categorytree-too-many-subcats' => 'Kan nie subkategorieë as boom wys nie, daar is te veel.',
);

/** Amharic (አማርኛ)
 * @author Codex Sinaiticus
 * @author Siebrand
 */
$messages['am'] = array(
	'categorytree'           => 'የመደቦች ዛፍ',
	'categorytree-legend'    => 'የመደቦች ዛፍ ለማየት',
	'categorytree-header'    => "[+] ተጭነው ንዑሱ-መደብ ይዘረጋል፣ [-] ተጭነው ደግሞ ይመልሳል። 

በግራ በኩል ባለው ሳጥን ውስጥ የመደቡን ስም ዝም ብለው መጻፍ ይችላሉ። (የዚሁ ዊኪ መደብ ስሞች ለመመልከት፣ [[Special:Mostlinkedcategories|እዚህ ይጫኑ]]።) ከዚያ፥ ምን ያሕል ንዑስ-መደቦች እንዳሉበት ለማየት «ዛፉ ይታይ» የሚለውን ይጫኑ። በቀኝ በኩል ካለው ሳጥን 'all pages' ከመረጡ፥ በየመደቡ ውስጥ ያሉት መጣጥፎች በተጨማሪ ይታያሉ።

''(ማስታወሻ: ይህ በኮምፒውተርዎ እንዲሠራ 'ጃቫ' የሚችል ዌብ-ብራውዘር ያስፈልጋል።)''",
	'categorytree-category'  => 'የመደብ ስም፦',
	'categorytree-go'        => 'ዛፉ ይታይ',
	'categorytree-parents'   => 'ላዕላይ መደቦች',
	'categorytree-loading'   => 'ሊመጣ ነው',
	'categorytree-not-found' => '«$1» የተባለ መደብ የለም።',
);

/** Aragonese (Aragonés)
 * @author Juanpabl
 * @author Siebrand
 */
$messages['an'] = array(
	'categorytree'                  => 'Árbol de categorías',
	'categorytree-tab'              => 'Árbol',
	'categorytree-legend'           => "Amostar l'árbol de categorías",
	'categorytree-desc'             => "Traste basato en AJAX t'amostrar a [[Special:CategoryTree|estrutura de categorías]] d'una wiki",
	'categorytree-header'           => "Escriba un nombre de categoría ta beyer os suyos contenius en forma d'árbol. Pare cuenta que ista pachina requiere as funzions JavaScriptz abanzatas conoixitas como AJAX. Si tiene un nabegador antigo, u tiene desautibato JavaScript, a pachina no funzionará.",
	'categorytree-category'         => 'Categoría:',
	'categorytree-go'               => "Amostrar l'Árbol",
	'categorytree-parents'          => 'Categorías mais',
	'categorytree-mode-categories'  => 'amostrar nomás categorías',
	'categorytree-mode-pages'       => 'pachinas pero no imachens',
	'categorytree-mode-all'         => 'todas as pachinas',
	'categorytree-collapse'         => 'amagar',
	'categorytree-expand'           => 'amostrar',
	'categorytree-load'             => 'cargar',
	'categorytree-loading'          => 'cargando',
	'categorytree-nothing-found'    => "No s'ha trobato cosa",
	'categorytree-no-subcategories' => 'no bi ha subcategorías',
	'categorytree-no-pages'         => 'No bi ha articlos ni subcategorías',
	'categorytree-not-found'        => "Categoría ''$1'' no trobata",
	'categorytree-error'            => 'Error en cargar os datos',
	'categorytree-retry'            => 'Por fabor, aspere bels intes y prebe de nuebas.',
	'categorytree-show-list'        => 'Amostrar como una lista',
	'categorytree-show-tree'        => 'Amostrar como un árbol',
	'categorytree-too-many-subcats' => "No se pueden amostrar as subcategorías como un árbol porque bi'n ha masiadas.",
);

/** Arabic (العربية)
 * @author Meno25
 * @author Siebrand
 */
$messages['ar'] = array(
	'categorytree'                  => 'شجرة تصنيف',
	'categorytree-tab'              => 'شجرة',
	'categorytree-legend'           => 'عرض شجرة التصنيف',
	'categorytree-desc'             => 'إضافة معتمدة على الأجاكس لعرض [[Special:CategoryTree|هيكل التصنيف]] لويكي',
	'categorytree-header'           => 'أدخل اسم تصنيف لترى محتوياته كتركيب شجري.
لاحظ أن هذا يتطلب خاصية جافاسكريبت متقدمة معروفة كأجاكس.
لو كنت تمتلك متصفحا قديما جدا، أو لديك الجافاسكريبت معطلة، فلن تعمل.',
	'categorytree-category'         => ':تصنيف',
	'categorytree-go'               => 'عرض الشجرة',
	'categorytree-parents'          => 'مصنف تحت',
	'categorytree-mode-categories'  => 'تصنيفات فقط',
	'categorytree-mode-pages'       => 'الصفحات ماعدا الصور',
	'categorytree-mode-all'         => 'كل الصفحات',
	'categorytree-collapse'         => 'ضغط',
	'categorytree-expand'           => 'فرد',
	'categorytree-load'             => 'تحميل',
	'categorytree-loading'          => 'جاري التحميل',
	'categorytree-nothing-found'    => 'لم يتم العثور على شيء',
	'categorytree-no-subcategories' => 'لا تصنيفات فرعية',
	'categorytree-no-pages'         => 'لا صفحات ولا تصنيفات فرعية',
	'categorytree-not-found'        => 'التصنيف <i>$1</i> لم يتم العثور عليه',
	'categorytree-error'            => 'مشكلة في تحميل البيانات.',
	'categorytree-retry'            => 'من فضلك انتظر لحظة وحاول مرة أخرى.',
	'categorytree-show-list'        => 'اعرض كقائمة',
	'categorytree-show-tree'        => 'اعرض كشجرة',
	'categorytree-too-many-subcats' => 'لا يمكن عرض التصنيفات الفرعية كشجرة، يوجد الكثير منهم.',
);

/** Asturian (Asturianu)
 * @author SPQRobin
 * @author Siebrand
 * @author Esbardu
 */
$messages['ast'] = array(
	'categorytree'                  => 'Árbole de categoríes',
	'categorytree-tab'              => 'Árbole',
	'categorytree-legend'           => "Amosar l'árbole de categoríes",
	'categorytree-desc'             => "Accesoriu basáu n'AJAX qu'amuesa la [[Special:CategoryTree|estructura de categoríes]] d'una wiki",
	'categorytree-header'           => "Escribi un nome de categoría pa ver el so conteníu estructuráu en forma
d'árbole. Fíxate en qu'esto requier la erbía AJAX de JavaScript. Si tienes
un navegador mui antiguu o'l JavaScript desactiváu, nun va funcionar.",
	'categorytree-category'         => 'Categoría:',
	'categorytree-go'               => 'Amosar árbole',
	'categorytree-parents'          => 'Categoríes superiores',
	'categorytree-mode-categories'  => 'categoríes namái',
	'categorytree-mode-pages'       => 'páxines sacante les imáxenes',
	'categorytree-mode-all'         => 'toles páxines',
	'categorytree-collapse'         => 'esconder',
	'categorytree-expand'           => 'espandir',
	'categorytree-load'             => 'cargar',
	'categorytree-loading'          => 'cargando',
	'categorytree-nothing-found'    => "nun s'atopó nada",
	'categorytree-no-subcategories' => 'nun hai subcategoríes',
	'categorytree-no-pages'         => 'ensin páxines nin subcategoríes',
	'categorytree-not-found'        => "Nun s'atopó la categoría <i>$1</i>",
	'categorytree-error'            => 'Hebo un problema al cargar los datos.',
	'categorytree-retry'            => 'Por favor, espera unos momentos y inténtalo otra vuelta.',
	'categorytree-show-list'        => 'Amosar como llista',
	'categorytree-show-tree'        => 'Amosar como árbole',
	'categorytree-too-many-subcats' => "Nun se puen amosar les subcategoríes en forma d'árbole porque hai demasiaes.",
);

/** Kotava (Kotava)
 * @author Wikimistusik
 * @author Siebrand
 */
$messages['avk'] = array(
	'categorytree'                  => 'LomaAal',
	'categorytree-tab'              => 'Aal',
	'categorytree-header'           => 'Ta wira va aaldrekoraf cek va lomayolt bazel !
Stragal da batcoba va AJAX JavaScript fliaca kucilar.
Ede va guazafi exulesiki favel oke ede JavaScript fliaceem tir metegis, batcoba me guyundeter.',
	'categorytree-category'         => 'Loma:',
	'categorytree-go'               => 'Nedira va aal',
	'categorytree-parents'          => 'Veylomeem',
	'categorytree-mode-categories'  => 'Anton lomeem',
	'categorytree-mode-pages'       => 'Bueem rade ewaveem',
	'categorytree-mode-all'         => 'bueem',
	'categorytree-collapse'         => 'koatcera',
	'categorytree-expand'           => 'divatcera',
	'categorytree-load'             => 'vajara',
	'categorytree-loading'          => 'vajas',
	'categorytree-nothing-found'    => 'mek trasiks',
	'categorytree-no-subcategories' => 'meka volveyloma',
	'categorytree-no-pages'         => 'meku bu oku volveyloma',
	'categorytree-not-found'        => '<i>$1</i> loma metrasiyina',
	'categorytree-error'            => 'Zvak remi origvajara.',
	'categorytree-retry'            => 'Vay kemel aze tolyawal !',
	'categorytree-show-list'        => 'Vexalakorafa nedira',
	'categorytree-show-tree'        => 'Aalkorafa nedira',
	'categorytree-too-many-subcats' => 'Aalkorafa nedira me rotir kire slika volveyloma tid.',
);

/** Bikol Central (Bikol Central)
 * @author Filipinayzd
 * @author Siebrand
 */
$messages['bcl'] = array(
	'categorytree-category'         => 'Kategorya:',
	'categorytree-mode-all'         => 'gabos na mga pahina',
	'categorytree-load'             => 'ikarga',
	'categorytree-loading'          => 'pigkakarga',
	'categorytree-nothing-found'    => 'mayong nahanap',
	'categorytree-no-subcategories' => 'mayong mga sub-kategorya',
	'categorytree-no-pages'         => 'mayong mga pahina o sub-kategorya',
	'categorytree-retry'            => 'Paki halat mûna tapos probaran giraray.',
	'categorytree-show-list'        => 'Ipahiling an lista',
);

/** Belarusian (Taraškievica orthography) (Беларуская (тарашкевіца))
 * @author Red Winged Duck
 * @author EugeneZelenko
 */
$messages['be-tarask'] = array(
	'categorytree'                  => 'Дрэва катэгорый',
	'categorytree-tab'              => 'Дрэва',
	'categorytree-desc'             => 'Заснаваная на AJAX прылада для паказу [[Special:CategoryTree|структуры катэгорый]] {{GRAMMAR:родны|{{SITENAME}}}}',
	'categorytree-category'         => 'Катэгорыя:',
	'categorytree-go'               => 'Паказаць дрэва',
	'categorytree-parents'          => 'Продкі',
	'categorytree-mode-categories'  => 'толькі катэгорыі',
	'categorytree-mode-pages'       => 'старонкі за выключэньнем файлаў',
	'categorytree-mode-all'         => 'усе старонкі',
	'categorytree-collapse'         => 'згарнуць',
	'categorytree-expand'           => 'разгарнуць',
	'categorytree-load'             => 'загрузіць',
	'categorytree-loading'          => 'загрузка…',
	'categorytree-nothing-found'    => 'нічога ня знойдзена',
	'categorytree-no-subcategories' => 'няма падкатэгорый',
	'categorytree-no-pages'         => 'няма старонак ці падкатэгорый',
	'categorytree-not-found'        => 'Катэгорыя <i>$1</i> ня знойдзена',
	'categorytree-error'            => 'Праблема загрузкі зьвестак.',
	'categorytree-retry'            => 'Калі ласка, пачакайце і паспрабуйце яшчэ раз.',
	'categorytree-show-list'        => 'Паказаць сьпіс',
	'categorytree-show-tree'        => 'Паказаць дрэва',
	'categorytree-too-many-subcats' => 'Немагчыма паказаць падкатэгорыі ў выглядзе дрэва, бо іх занадта шмат.',
);

/** Bulgarian (Български)
 * @author DCLXVI
 * @author Spiritia
 * @author Borislav
 */
$messages['bg'] = array(
	'categorytree'                  => 'Дърво на категориите',
	'categorytree-tab'              => 'Дърво',
	'categorytree-legend'           => 'Показване на дървото с категориите',
	'categorytree-desc'             => 'Инструмент на AJAX, който показва [[Special:CategoryTree|структурата на категориите]] в уикито',
	'categorytree-header'           => 'Въведете категория, за да видите съдържанието й в дървовиден вид от категории. Имайте предвид, че това изисква допълнителна JavaScript-функционалност, позната като AJAX. Тази възможност не може да бъде използвана, ако използвате стар браузър или сте изключили поддържането на JavaScript.',
	'categorytree-category'         => 'Категория',
	'categorytree-go'               => 'Показване',
	'categorytree-parents'          => 'Родителски категории',
	'categorytree-mode-categories'  => 'само категории',
	'categorytree-mode-pages'       => 'страници, без файлове',
	'categorytree-mode-all'         => 'всички страници',
	'categorytree-collapse'         => 'събиране',
	'categorytree-expand'           => 'разпъване',
	'categorytree-load'             => 'зареждане',
	'categorytree-loading'          => 'зареждане',
	'categorytree-nothing-found'    => 'няма открити подкатегории',
	'categorytree-no-subcategories' => 'няма подкатегории',
	'categorytree-no-pages'         => 'няма страници или подкатегории',
	'categorytree-not-found'        => 'Категорията <i>$1</i> не беше намерена',
	'categorytree-error'            => 'Възникна проблем при зареждане на информацията.',
	'categorytree-retry'            => 'Изчакайте малко и опитайте отново.',
	'categorytree-show-list'        => 'Показване като списък',
	'categorytree-show-tree'        => 'Показване като дърво',
	'categorytree-too-many-subcats' => 'Съществуват твърде много подкатегории, невъзможно е да бъдат показани като дърво.',
);

/** Bengali (বাংলা)
 * @author Zaheen
 * @author Siebrand
 */
$messages['bn'] = array(
	'categorytree'                  => 'বিষয়শ্রেণীবৃক্ষ',
	'categorytree-tab'              => 'বৃক্ষ',
	'categorytree-desc'             => 'কোন উইকির [[Special:CategoryTree|বিষয়শ্রেণী কাঠামো]] প্রদর্শনের জন্য এজ্যাক্স-ভিত্তিক গ্যাজেট',
	'categorytree-header'           => 'যে বিষয়শ্রেণীটির অন্তর্ভুক্ত বিষয়বস্তু বৃক্ষাকারে দেখতে চান, সেটির নাম প্রবেশ করান।
লক্ষ্য করুন এর জন্য এজ্যাক্স নামের একটি অগ্রসর জাভাস্ক্রিপ্ট কৌশল ব্যবহার করা হয়।
যদি আপনার ব্রাউজারটি খুব পুরনো হয়, বা যদি জাভাস্ক্রিপ্ট নিষ্ক্রিয় করা থাকে, তবে এটি কাজ করবে না।',
	'categorytree-category'         => 'বিষয়শ্রেণী:',
	'categorytree-go'               => 'বৃক্ষ দেখানো হোক',
	'categorytree-parents'          => 'পিতামাতা',
	'categorytree-mode-categories'  => 'শুধুমাত্র বিষয়শ্রেণী',
	'categorytree-mode-pages'       => 'ছবি ব্যতীত সব পাতা',
	'categorytree-mode-all'         => 'সব পাতা',
	'categorytree-collapse'         => 'গুটিয়ে ফেলা হোক',
	'categorytree-expand'           => 'প্রসারিত করা হোক',
	'categorytree-load'             => 'নিয়ে আসা হোক',
	'categorytree-loading'          => 'নিয়ে আসা হচ্ছে',
	'categorytree-nothing-found'    => 'কিছু পাওয়া যায়নি',
	'categorytree-no-subcategories' => 'কোন উপ-বিষয়শ্রেণী নেই',
	'categorytree-no-pages'         => 'কোন পাতা বা উপ-বিষয়শ্রেণী নেই',
	'categorytree-not-found'        => '<i>$1</i> বিষয়শ্রেণীটি খুঁজে পাওয়া যায়নি',
	'categorytree-error'            => 'উপাত্ত নিয়ে আসতে সমস্যা।',
	'categorytree-retry'            => 'অনুগ্রহ করে একটু অপেক্ষা করে আবার চেষ্টা করুন।',
	'categorytree-show-list'        => 'তালিকা আকারে দেখানো হোক',
	'categorytree-show-tree'        => 'বৃক্ষাকারে দেখানো হোক',
	'categorytree-too-many-subcats' => 'উপবিষয়শ্রেণীগুলি সংখ্যায় খুব বেশি বলে এগুলি বৃক্ষাকারে দেখানো গেল না।',
);

/** Breton (Brezhoneg)
 * @author Fulup
 * @author Siebrand
 */
$messages['br'] = array(
	'categorytree'                  => 'Gwezennadur ar rummadoù',
	'categorytree-tab'              => 'Gwezennadur',
	'categorytree-legend'           => 'Gwelet gwezennadur ar rummad',
	'categorytree-desc'             => 'Bitrak diazezet war AJAX evit diskouez [[Special:CategoryTree|framm rummad]] ur wiki',
	'categorytree-header'           => "Merkit anv ur rummad evit gwelet petra zo ennañ e stumm ur gwezennadur. 
Notit e rankit kaout an arc'hwelioù JavaScript araokaet anvet AJAX.
M'eo kozh-mat stumm ho merdeer pe m'eo diweredekaet JavaScript ganeoc'h, ne'z aio ket en-dro.",
	'categorytree-category'         => 'Rummad:',
	'categorytree-go'               => 'Diskouez ar gwezennadur',
	'categorytree-parents'          => 'Usrummadoù',
	'categorytree-mode-categories'  => 'Rummadoù hepken',
	'categorytree-mode-pages'       => 'Pajennoù hep ar skeudennoù',
	'categorytree-mode-all'         => 'an holl bajennoù',
	'categorytree-collapse'         => 'Serriñ',
	'categorytree-expand'           => 'Dispakañ',
	'categorytree-load'             => 'kargañ',
	'categorytree-loading'          => 'o kargañ',
	'categorytree-nothing-found'    => 'Netra bet kavet',
	'categorytree-no-subcategories' => 'isrummad ebet',
	'categorytree-no-pages'         => 'Pennad ebet hag isrummad ebet',
	'categorytree-not-found'        => "N'eo ket bet kavet ar rummad <i>$1</i>",
	'categorytree-error'            => 'Ur gudenn zo bet e-ser kargañ ar roadennoù.',
	'categorytree-retry'            => 'Gortozit un tamm ha klaskit en-dro.',
	'categorytree-show-list'        => 'Diskouez er mod roll',
	'categorytree-show-tree'        => 'Diskouez er mod gwezennadur',
	'categorytree-too-many-subcats' => "N'haller ket diskouez an isrummadoù er mod roll, re zo anezho.",
);

/** Bosnian (Bosanski)
 * @author editors of bs.wikipedia
 */
$messages['bs'] = array(
	'categorytree'                  => 'Stablo kategorije',
	'categorytree-tab'              => 'Stablo',
	'categorytree-header'           => 'Unesite ime kategorije da vidite njen sadržaj kao strukturno stablo. Ovo zahtijeva proširenu JavaScript funkcionalnost kao AJAX. Ako imate neki stariji Internet preglednik, ili ste iskljucili JavaScript, ovo nece raditi.',
	'categorytree-category'         => 'Kategorija',
	'categorytree-go'               => 'Prikaži stablo',
	'categorytree-parents'          => 'Nadkategorije',
	'categorytree-mode-categories'  => 'samo kategorije',
	'categorytree-mode-pages'       => 'stranice umjesto slika',
	'categorytree-mode-all'         => 'sve stranice',
	'categorytree-collapse'         => 'sakrij',
	'categorytree-expand'           => 'proširi',
	'categorytree-load'             => 'ucitaj',
	'categorytree-loading'          => 'ucitavam',
	'categorytree-nothing-found'    => 'nema podkategorija',
	'categorytree-no-subcategories' => 'nema podkategorija',
	'categorytree-no-pages'         => 'nema podkategorija ili clanaka',
	'categorytree-show-list'        => 'Prikaži kao listu',
	'categorytree-show-tree'        => 'Prikaži kao stablo',
	'categorytree-too-many-subcats' => 'Ne mogu prikazati podkategorije, previše ih je.',
);

/** Catalan (Català)
 * @author SMP
 * @author Paucabot
 */
$messages['ca'] = array(
	'categorytree'                  => 'Categories en arbre',
	'categorytree-tab'              => 'Arbre',
	'categorytree-legend'           => "Mostra l'arbre de categories",
	'categorytree-desc'             => "Gadget fet amb AJAX per a mostrar l'[[Special:CategoryTree|estructura de les categories]] d'un wiki",
	'categorytree-header'           => "Entreu el nom d'una categoria per a veure l'arbre del seu contingut. Aquesta pàgina utilitza una funcionalitat avançada del JavaScript coneguda com a AJAX, i no funciona en navegadors antics o que tinguin el JavaScript desactivat.",
	'categorytree-category'         => 'Categoria:',
	'categorytree-go'               => 'Carregueu',
	'categorytree-parents'          => 'Categories pare',
	'categorytree-mode-categories'  => 'mostra només categories',
	'categorytree-mode-pages'       => 'mostra categories i pàgines',
	'categorytree-mode-all'         => 'mostra categories, pàgines i imatges',
	'categorytree-collapse'         => 'Tancar',
	'categorytree-expand'           => 'Expandir',
	'categorytree-load'             => 'Carrega',
	'categorytree-loading'          => 'carregant',
	'categorytree-nothing-found'    => 'no hi ha sub-categories',
	'categorytree-no-subcategories' => 'no hi ha subcategories.',
	'categorytree-no-pages'         => 'no hi ha articles o subcategories.',
	'categorytree-not-found'        => "No s'ha trobat la categoria ''$1''.",
	'categorytree-error'            => 'Problema en la càrrega de dades.',
	'categorytree-retry'            => 'Torneu-ho a intentar en uns moments.',
	'categorytree-show-list'        => 'Mostra com a llista',
	'categorytree-show-tree'        => 'Mostra com un arbre',
	'categorytree-too-many-subcats' => 'Hi ha massa subcategories per a mostrar-les com a arbre.',
);

/** Mìng-dĕ̤ng-ngṳ̄ (Mìng-dĕ̤ng-ngṳ̄)
 * @author GnuDoyng
 */
$messages['cdo'] = array(
	'categorytree'                  => 'Lôi-biék chéu',
	'categorytree-tab'              => 'Chéu',
	'categorytree-header'           => 'Sṳ̆-ĭk lôi-biék miàng-chĭng, káng ĭ gì chéu-hìng giék-gáiu. Chiāng cé̤ṳ-é, ciā hiĕk-miêng sāi-ê̤ṳng siŏh cṳ̄ng gŏ̤-gék JavaScript gé-sŭk, giéu lō̤ AJAX. Nṳ̄ nâ sāi-ê̤ṳng guó-sì gì báuk-lāng-ké, hĕ̤k-ciā cĕk lâi JavaScript, cêu mâ̤ ciáng-siòng gĕ̤ng-cáuk.',
	'categorytree-category'         => 'Hŭng-lôi',
	'categorytree-go'               => 'Hiēng-sê chéu',
	'categorytree-mode-categories'  => 'nâ ô lôi-biék',
	'categorytree-mode-pages'       => 'dù-piéng ī-nguôi gì hiĕk-miêng',
	'categorytree-mode-all'         => 'tĕ̤k-chṳ̄',
	'categorytree-loading'          => 'tĕ̤k-chṳ̄',
	'categorytree-no-subcategories' => 'mò̤ cṳ̄-lôi-biék',
	'categorytree-no-pages'         => 'mò̤ hiĕk-miêng hĕ̤k cṳ̄-lôi-biék',
	'categorytree-not-found'        => 'Mò̤ tō̤ diŏh lôi-biék <i>$1</i>',
);

/** Corsican (Corsu)
 * @author SPQRobin
 * @author Siebrand
 */
$messages['co'] = array(
	'categorytree-category'   => 'Categuria:',
	'categorytree-mode-pages' => 'pagine senza imagin',
	'categorytree-mode-all'   => 'tutte e pagine',
);

/** Czech (Česky)
 * @author Danny B.
 * @author Li-sung
 */
$messages['cs'] = array(
	'categorytree'                  => 'Strom kategorií',
	'categorytree-tab'              => 'Strom',
	'categorytree-legend'           => 'Zobrazí strom kategorie',
	'categorytree-desc'             => 'Ajaxový nástroj zobrazující [[Special:CategoryTree|stromovou strukturu kategorií]] na této wiki',
	'categorytree-header'           => 'Zadejte název kategorie k&nbsp;zobrazení jejího obsahu jako stromové struktury.

(Tato funkce vyžaduje pokročilé funkce JavaScriptu známé jako Ajax. Jestliže máte velmi starý prohlížeč nebo vypnutý JavaScript, nezobrazí se strom správně nebo vůbec.)',
	'categorytree-category'         => 'Kategorie',
	'categorytree-go'               => 'Zobrazit',
	'categorytree-parents'          => 'Nadřazené kategorie',
	'categorytree-mode-categories'  => 'pouze kategorie',
	'categorytree-mode-pages'       => 'stránky kromě souborů',
	'categorytree-mode-all'         => 'všechny stránky',
	'categorytree-collapse'         => 'zavřít',
	'categorytree-expand'           => 'otevřít',
	'categorytree-load'             => 'načíst',
	'categorytree-loading'          => 'načítá se',
	'categorytree-nothing-found'    => 'nic nebylo nalezeno',
	'categorytree-no-subcategories' => 'žádné podkategorie.',
	'categorytree-no-pages'         => 'žádné články ani podkategorie.',
	'categorytree-not-found'        => 'Kategorie <em>$1</em> nenalezena',
	'categorytree-error'            => 'Chyba při načítání dat.',
	'categorytree-retry'            => 'Počkejte chvilku a zkuste to znova.',
	'categorytree-show-list'        => 'Zobrazi jako seznam',
	'categorytree-show-tree'        => 'Zobrazit jako strom',
	'categorytree-too-many-subcats' => 'Podkategorie není možné zobrazit ve stromové struktuře, protože je jich příliš mnoho.',
);

/** Welsh (Cymraeg)
 * @author Lloffiwr
 */
$messages['cy'] = array(
	'categorytree'                  => 'CoedenGategori',
	'categorytree-tab'              => 'Coeden',
	'categorytree-legend'           => 'Dangos y goeden gategori',
	'categorytree-desc'             => "Teclyn AJAX yn arddangos [[Special:CAtegoryTree|adeiledd categorïau]]'r wici",
	'categorytree-header'           => "Teipiwch enw categori yn y blwch er mwyn gweld ei gynnwys ar lun coeden. 
Sylwer bod yn rhaid defnyddio offer uwch Sgript Java o'r enw AJAX er mwyn gwneud hyn. 
Ni lwydda'r gofyniad os yw'ch porwr yn hen iawn neu os nad yw Sgript Java wedi ei alluogi.",
	'categorytree-category'         => 'Categori:',
	'categorytree-go'               => 'Dangos y Goeden',
	'categorytree-parents'          => 'Rhieni',
	'categorytree-mode-categories'  => 'categorïau yn unig',
	'categorytree-mode-pages'       => 'tudalennau ag eithrio delweddau',
	'categorytree-mode-all'         => 'pob tudalen',
	'categorytree-collapse'         => 'crebachu',
	'categorytree-expand'           => 'ehangu',
	'categorytree-load'             => 'llwytho',
	'categorytree-loading'          => "wrthi'n llwytho...",
	'categorytree-nothing-found'    => "dim i'w gael",
	'categorytree-no-subcategories' => 'dim is-gategorïau',
	'categorytree-no-pages'         => 'dim tudalennau nag is-gategorïau',
	'categorytree-not-found'        => "Heb ddod o hyd i'r categori <i>$1</i>",
	'categorytree-error'            => "Cafwyd problem wrth lwytho'r data.",
	'categorytree-retry'            => 'Arhoswch ennyd, yna ceisiwch eto.',
	'categorytree-show-list'        => 'Dangos ar lun rhestr',
	'categorytree-show-tree'        => 'Dangos ar lun coeden',
	'categorytree-too-many-subcats' => 'Yn methu dangos yr is-gategorïau ar lun coeden gan bod gormod ohonynt.',
);

/** Danish (Dansk)
 * @author Barklund
 * @author Morten
 * @author Jon Harald Søby
 */
$messages['da'] = array(
	'categorytree'                  => 'Kategoritræ',
	'categorytree-tab'              => 'Træ',
	'categorytree-header'           => 'Indtast navnet på en kategori for at se indholdet som et træ. Bemærk at dette kræver avanceret JavaScript-funktionalitet kendt som AJAX, det virker ikke hvis du har en meget gammel browser eller hvis du har slået JavaScript fra.',
	'categorytree-category'         => 'Kategori:',
	'categorytree-go'               => 'Henter',
	'categorytree-parents'          => 'Overkategorier',
	'categorytree-mode-categories'  => 'vis kun kategorier',
	'categorytree-mode-pages'       => 'sider undtaget billeder',
	'categorytree-mode-all'         => 'alle sider',
	'categorytree-collapse'         => 'fold sammen',
	'categorytree-expand'           => 'fold ud',
	'categorytree-load'             => 'hent',
	'categorytree-loading'          => 'indlæser',
	'categorytree-nothing-found'    => 'Ikke fundet, desværre.',
	'categorytree-no-subcategories' => 'Ingen underkategorier.',
	'categorytree-no-pages'         => 'Ingen artikler eller underkategorier.',
	'categorytree-not-found'        => "Kategorien ''$1'' blev ikke fundet",
	'categorytree-error'            => 'Der opstod et problem under indlæsning af data.',
	'categorytree-retry'            => 'Vent et øjeblik og prøv igen.',
	'categorytree-show-list'        => 'Vis som liste',
	'categorytree-show-tree'        => 'Vis som træ',
	'categorytree-too-many-subcats' => 'Kan ikke vise underkategorier som træ, der er for mange.',
);

/** German (Deutsch)
 * @author Raimond Spekking
 */
$messages['de'] = array(
	'categorytree'                  => 'Kategorienbaum',
	'categorytree-tab'              => 'Baum',
	'categorytree-legend'           => 'Zeige Kategorienbaum',
	'categorytree-desc'             => 'Ajax-basiertes Gadget, um die [[Special:CategoryTree|Kategorien-Struktur]] eines Wikis anzuzeigen',
	'categorytree-header'           => 'Zeigt für die angegebene Kategorie die Unterkategorien in einer Baumstruktur.
Diese Seite benötigt bestimmte JavaScript-Funktionen (Ajax) und funktioniert möglicherweise nicht, wenn JavaScript ausgeschaltet ist oder ein sehr alter Browser verwendet wird.',
	'categorytree-category'         => 'Kategorie:',
	'categorytree-go'               => 'Laden',
	'categorytree-parents'          => 'Oberkategorien',
	'categorytree-mode-categories'  => 'nur Kategorien',
	'categorytree-mode-pages'       => 'Seiten außer Bilder',
	'categorytree-mode-all'         => 'alle Seiten',
	'categorytree-collapse'         => 'einklappen',
	'categorytree-expand'           => 'ausklappen',
	'categorytree-load'             => 'laden',
	'categorytree-loading'          => 'laden …',
	'categorytree-nothing-found'    => 'Nichts gefunden',
	'categorytree-no-subcategories' => 'Keine Unterkategorien',
	'categorytree-no-pages'         => 'Keine Seite oder Unterkategorien',
	'categorytree-not-found'        => "Kategorie „$1“ nicht gefunden",
	'categorytree-error'            => 'Probleme beim Laden der Daten.',
	'categorytree-retry'            => 'Bitte warte einen Moment und versuche es dann erneut.',
	'categorytree-show-list'        => 'Zeige als Liste',
	'categorytree-show-tree'        => 'Zeige als Baum',
	'categorytree-too-many-subcats' => 'Unterkategorien können nicht als Baum dargestellt werden, da es zuviele sind.',
);

/** German - formal address (Deutsch - förmliche Anrede)
 * @author Raimond Spekking
 */
$messages['de-formal'] = array(
	'categorytree-retry'            => 'Bitte warten Sie einen Moment und versuchen Sie es dann erneut.',
);

/** Zazaki (Zazaki)
 * @author Siebrand
 * @author SPQRobin
 */
$messages['diq'] = array(
	'categorytree'          => 'Dara Kategoriye',
	'categorytree-category' => 'Kategoriye:',
);

/** Lower Sorbian (Dolnoserbski)
 * @author Michawiki
 * @author Siebrand
 */
$messages['dsb'] = array(
	'categorytree'                  => 'Bom kategorijow',
	'categorytree-tab'              => 'Bom',
	'categorytree-header'           => 'Zapodaj mě kategorije, aby jeje wopśimjeśe ako bomowu strukturu wiźeł.
Glědaj, až se to wěste funkcije JavaScripta pomina, znate ako AJAX.
Jolic maš wjelgin stary browser abo jolic JavaScript jo wótšaltowane, toś ten bok ewentuelnje njefunkcioněrujo.',
	'categorytree-category'         => 'Kategorija:',
	'categorytree-go'               => 'Bom pokazaś',
	'categorytree-parents'          => 'Wuše kategorije',
	'categorytree-mode-categories'  => 'jano kategorije',
	'categorytree-mode-pages'       => 'Boki mimo wobrazow',
	'categorytree-mode-all'         => 'wšykne boki',
	'categorytree-collapse'         => 'złožyś',
	'categorytree-expand'           => 'rozłožyś',
	'categorytree-load'             => 'lodowaś',
	'categorytree-loading'          => 'lodujo se...',
	'categorytree-nothing-found'    => 'Nic namakany',
	'categorytree-no-subcategories' => 'Žedne pódkategorije',
	'categorytree-no-pages'         => 'Žedne boki abo pódkategorije',
	'categorytree-not-found'        => 'Kategorija <i>$1</i> njenamakana',
	'categorytree-error'            => 'Problem pśi lodowanju datow.',
	'categorytree-retry'            => 'Pócakaj pšosym moment a wopytaj hyšći raz.',
	'categorytree-show-list'        => 'Ako lisćinu pokazaś',
	'categorytree-show-tree'        => 'Ako bom pokazaś',
	'categorytree-too-many-subcats' => 'Pódkategorije njedaju se ako bom pokazaś, jo pśewjele z nich.',
);

/** Ewe (Eʋegbe)
 * @author M.M.S.
 */
$messages['ee'] = array(
	'categorytree-mode-all' => 'axawo katã',
);

/** Greek (Ελληνικά)
 * @author Consta
 * @author ZaDiak
 * @author Badseed
 * @author Siebrand
 */
$messages['el'] = array(
	'categorytree-tab'              => 'Δέντρο',
	'categorytree-category'         => 'Κατηγορία:',
	'categorytree-parents'          => 'Γονείς',
	'categorytree-mode-categories'  => 'μόνο κατηγορίες',
	'categorytree-mode-all'         => 'όλες οι σελίδες',
	'categorytree-expand'           => 'επέκτεινε',
	'categorytree-load'             => 'φόρτωσε',
	'categorytree-loading'          => 'φόρτωση',
	'categorytree-no-subcategories' => 'καμία υποκατηγορία',
	'categorytree-no-pages'         => 'καμία σελίδα ή υποκατηγορία',
	'categorytree-not-found'        => 'Η κατηγορία <i>$1</i> δεν βρέθηκε',
	'categorytree-error'            => 'Πρόβλημα φόρτωσης δεδομένων.',
	'categorytree-retry'            => 'Παρακαλώ περιμένετε μια στιγμή και προσπαθήστε ξανά.',
	'categorytree-show-list'        => 'Δες ως λίστα',
);

/** Esperanto (Esperanto)
 * @author Yekrats
 * @author Tlustulimu
 */
$messages['eo'] = array(
	'categorytree'                  => 'Kategoriarbo',
	'categorytree-tab'              => 'Arbo',
	'categorytree-legend'           => 'Montru kategorian arbon',
	'categorytree-desc'             => 'AJAX-bazita aldonaĵo por montri la [[Special:CategoryTree|kategorian strukturon]] de vikio',
	'categorytree-header'           => 'Tajpu kategorinomon por vidi ties entenon en arbforma strukturo. Notu ke tio postulas javaskripatajn funkciojn nomitajn AJAX. Se via foliumilo estas tre malnova au se Javaskripto estas malaktivigita, tio ne funkcios.',
	'categorytree-category'         => 'Kategorio:',
	'categorytree-go'               => 'Montru arbon',
	'categorytree-parents'          => 'praul(ar)o',
	'categorytree-mode-categories'  => 'nur kategorioj',
	'categorytree-mode-pages'       => 'pagoj krom bildpagoj',
	'categorytree-mode-all'         => 'ĉiuj paĝoj',
	'categorytree-collapse'         => 'kunfaldu',
	'categorytree-expand'           => 'etendu',
	'categorytree-load'             => 'alŝuti',
	'categorytree-loading'          => 'ŝarĝante',
	'categorytree-nothing-found'    => 'nenio trovita',
	'categorytree-no-subcategories' => 'neniu subkategorio',
	'categorytree-no-pages'         => 'neniu pago o subkategorio',
	'categorytree-not-found'        => 'La kategorio <i>$1</i> ne estis trovita.',
	'categorytree-error'            => 'Problemo ŝarĝante datojn',
	'categorytree-retry'            => 'Bonvolu atendi momenton kaj provi denove.',
	'categorytree-show-list'        => 'Montru listforme',
	'categorytree-show-tree'        => 'Montru arbforme',
	'categorytree-too-many-subcats' => 'Ne eblas montri subkategoriojn arbforme : estas tro multe da ili.',
);

/** Spanish (Español)
 * @author Spacebirdy
 */
$messages['es'] = array(
	'categorytree'                  => 'Árbol de categorías (CategoryTree)',
	'categorytree-tab'              => 'Árbol',
	'categorytree-header'           => 'Escribe un nombre de categoría para ver su contenido con una estructura en árbol.
Ten en cuenta que esto requiere funciones JavaScript avanzadas conocidas como AJAX.
Si tienes un navegador antiguo, o tienes deshabilitado el JavaScript, esto no funcionará.',
	'categorytree-category'         => 'Categoría',
	'categorytree-go'               => 'Cargar',
	'categorytree-parents'          => 'Categorías superiores',
	'categorytree-mode-categories'  => 'mostrar sólo categorías',
	'categorytree-mode-pages'       => 'páginas excepto imágenes',
	'categorytree-mode-all'         => 'todas las páginas',
	'categorytree-collapse'         => 'ocultar',
	'categorytree-expand'           => 'mostrar',
	'categorytree-load'             => 'cargar',
	'categorytree-loading'          => 'cargando',
	'categorytree-nothing-found'    => 'Lo sentimos, no se ha encontrado nada',
	'categorytree-no-subcategories' => 'sin subcategorías.',
	'categorytree-no-pages'         => 'sin artículos ni subcategorías.',
	'categorytree-not-found'        => "Categoría ''$1'' no encontrada",
	'categorytree-error'            => 'Error al cargar los datos',
);

/** Estonian (Eesti)
 * @author SPQRobin
 * @author Siebrand
 */
$messages['et'] = array(
	'categorytree'                  => 'Kategooriapuu',
	'categorytree-category'         => 'Kategooria:',
	'categorytree-mode-categories'  => 'ainult kategooriad',
	'categorytree-mode-pages'       => 'leheküljed, välja arvatud pildid',
	'categorytree-mode-all'         => 'kõik leheküljed',
	'categorytree-no-subcategories' => 'alamkategooriaid ei ole',
	'categorytree-show-list'        => 'Näita nimekirjana',
	'categorytree-show-tree'        => 'Näita kategooriapuuna',
);

/** Basque (Euskara)
 * @author SPQRobin
 */
$messages['eu'] = array(
	'categorytree'                  => 'Kategoria Zuhaitza',
	'categorytree-tab'              => 'Zuhaitza',
	'categorytree-header'           => 'Idatzi kategoria baten izena bere edukia zuhaitz eran ikusteko. Kontuan izan horrek AJAX bezala ezagutzen diren JavaScript funtzio aurreratuen beharra duela. Nabigatzaile zahar bat erabiltzen baduzu, edo JavaScript ezgaituta badaukazu, ez du funtzionatuko.',
	'categorytree-category'         => 'Kategoria',
	'categorytree-go'               => 'Zuhaitza Erakutsi',
	'categorytree-parents'          => 'Gurasoak',
	'categorytree-mode-categories'  => 'kategoriak bakarrik',
	'categorytree-mode-pages'       => 'orrialdeak, irudiak ezik',
	'categorytree-mode-all'         => 'orrialde guztiak',
	'categorytree-collapse'         => 'itxi',
	'categorytree-expand'           => 'zabaldu',
	'categorytree-load'             => 'kargatu',
	'categorytree-loading'          => 'kargatzen',
	'categorytree-nothing-found'    => 'ez da ezer aurkitu',
	'categorytree-no-subcategories' => 'ez dago azpikategoriarik',
	'categorytree-no-pages'         => 'ez dago orrialde edo azpikategoriarik',
	'categorytree-not-found'        => 'Ez da <i>$1</i> kategoria aurkitu',
	'categorytree-error'            => 'Arazoa datuak kargatzerakoan.',
	'categorytree-retry'            => 'Itxaron pixka bat eta saiatu berriz.',
	'categorytree-show-list'        => 'Zerrenda eran erakutsi',
	'categorytree-show-tree'        => 'Zuhaitz eran erakutsi',
	'categorytree-too-many-subcats' => 'Ezin dira azpikategoriak zuhaitz eran erakutsi, gehiegi dira-eta.',
);

/** Extremaduran (Estremeñu)
 * @author Better
 * @author Siebrand
 */
$messages['ext'] = array(
	'categorytree'          => 'Arbu e categorias',
	'categorytree-tab'      => 'Arbu',
	'categorytree-category' => 'Categoria:',
	'categorytree-load'     => 'cargal',
	'categorytree-loading'  => 'cargandu',
	'categorytree-no-pages' => 'nu ai ni páhinas ni sucategorias',
);

/** Persian (فارسی)
 * @author Huji
 */
$messages['fa'] = array(
	'categorytree'                  => 'درخت رده',
	'categorytree-tab'              => 'درخت',
	'categorytree-legend'           => 'نمایش درخت رده',
	'categorytree-desc'             => 'ابزار مبتنی بر AJAX برای نمایش [[Special:CategoryTree|ساختار رده‌های]] یک ویکی',
	'categorytree-header'           => 'نام یک رده را وارد کنید تا محتویات آن به صورت درخت نمایش یابد. توجه کنید که این کار نیاز به قابلیت‌های پیشرفتهٔ جاوااسکریپت موسوم به آژاکس دارد. اگر از مرورگری خیلی قدیمی استفاده می‌کنید یا جاوااسکریپت را غیرفعال کرده‌اید، کار نمی‌کند.',
	'categorytree-category'         => 'رده',
	'categorytree-go'               => 'نمايش درخت',
	'categorytree-parents'          => 'والدین',
	'categorytree-mode-categories'  => 'فقط رده‌ها',
	'categorytree-mode-pages'       => 'صفحه‌های جز تصویر',
	'categorytree-mode-all'         => 'همهٔ صفحه‌ها',
	'categorytree-collapse'         => 'مچالش',
	'categorytree-expand'           => 'گسترش',
	'categorytree-load'             => 'بارکردن',
	'categorytree-loading'          => 'در حال بارگیری',
	'categorytree-nothing-found'    => 'هیچ‌چیز یافت نشد.',
	'categorytree-no-subcategories' => 'هیچ زیررده‌ای ندارد.',
	'categorytree-no-pages'         => 'هیچ صفحه یا زیررده‌ای ندارد.',
	'categorytree-not-found'        => "ردهٔ  ''$1'' يافت نشد.",
	'categorytree-error'            => 'اشکال در دریافت اطلاعات.',
	'categorytree-retry'            => 'لطفاً چند لحظه صبر کنید و سپس دوباره امتحان کنید.',
	'categorytree-show-list'        => 'نمایش فهرست‌وار',
	'categorytree-show-tree'        => 'نمایش درخت‌وار',
	'categorytree-too-many-subcats' => 'به خاطر شمار زیاد آنها، نمی‌توان زیررده‌ها را درخت‌وار نشان داد.',
);

/** Finnish (Suomi)
 * @author Crt
 * @author Nike
 */
$messages['fi'] = array(
	'categorytree'                  => 'Luokkapuu',
	'categorytree-tab'              => 'Puu',
	'categorytree-legend'           => 'Näytä luokkapuu',
	'categorytree-desc'             => 'AJAX-pohjainen laajennus, joka näyttää wikin [[Special:CategoryTree|luokkapuurakenteen]].',
	'categorytree-header'           => 'Syötä alle luokka, jonka haluat nähdä puumuodossa. Tämä toiminnallisuus vaatii kehittyneen JavaScript tuen, jota kutsutaan AJAXiksi. Jos sinulla on vanha selain, tai JavaScript ei ole päällä, tämä ominaisuus ei toimi.',
	'categorytree-category'         => 'Luokka',
	'categorytree-go'               => 'Näytä puu',
	'categorytree-parents'          => 'Yläluokat',
	'categorytree-mode-categories'  => 'vain luokat',
	'categorytree-mode-pages'       => 'kaikki sivut kuvia lukuun ottamatta',
	'categorytree-mode-all'         => 'kaikki sivut',
	'categorytree-collapse'         => 'piilota',
	'categorytree-expand'           => 'näytä',
	'categorytree-load'             => 'näytä',
	'categorytree-loading'          => 'etsitään',
	'categorytree-nothing-found'    => 'ei alaluokkia',
	'categorytree-no-subcategories' => 'ei alaluokkia',
	'categorytree-no-pages'         => 'ei sivuja eikä alaluokkia',
	'categorytree-not-found'        => 'Luokkaa <i>$1</i> ei löytynyt',
	'categorytree-error'            => 'Ongelma tietojen latauksessa.',
	'categorytree-retry'            => 'Odota hetki ja yritä uudelleen.',
	'categorytree-show-list'        => 'Näytä luettelona',
	'categorytree-show-tree'        => 'Näytä puuna',
	'categorytree-too-many-subcats' => 'Alaluokkia ei voida näyttää puuna, koska niitä on liian monta.',
);

/** Faroese (Føroyskt)
 * @author Spacebirdy
 * @author Siebrand
 */
$messages['fo'] = array(
	'categorytree'          => 'BólkaTræ',
	'categorytree-category' => 'Bólkur:',
	'categorytree-go'       => 'Vís træ',
	'categorytree-mode-all' => 'allar síður',
);

/** French (Français)
 * @author Meithal
 * @author Sherbrooke
 * @author Grondin
 */
$messages['fr'] = array(
	'categorytree'                  => 'Arborescence des catégories',
	'categorytree-tab'              => 'Arbre',
	'categorytree-legend'           => 'Visionner l’arborescence de la catégorie',
	'categorytree-desc'             => 'Gadget basé sur AJAX pour afficher la [[Special:CategoryTree|structure de la catégorie]] d’un wiki',
	'categorytree-header'           => 'Entrez un nom de catégorie pour voir son contenu en structure arborescente. Ceci utilise des fonctionnalités JavaScript avancées connues sous le nom d’AJAX. Si vous avez un très vieux navigateur Web ou si vous n’avez pas activé la fonctionnalité JavaScript, cela ne fonctionnera pas.',
	'categorytree-category'         => 'Catégorie',
	'categorytree-go'               => 'voir l’arborescence',
	'categorytree-parents'          => 'Sur-catégorie(s) ',
	'categorytree-mode-categories'  => 'seulement les catégories',
	'categorytree-mode-pages'       => 'pages sans les images',
	'categorytree-mode-all'         => 'toutes les pages',
	'categorytree-collapse'         => 'Refermer',
	'categorytree-expand'           => 'Développer',
	'categorytree-load'             => 'Ouvrir',
	'categorytree-loading'          => 'ouverture...',
	'categorytree-nothing-found'    => 'Aucune',
	'categorytree-no-subcategories' => 'Aucune sous-catégorie.',
	'categorytree-no-pages'         => 'Aucun article ou sous-catégorie.',
	'categorytree-not-found'        => 'La catégorie <tt>$1</tt> n’a pas été trouvée.',
	'categorytree-error'            => 'Problème de chargement des données.',
	'categorytree-retry'            => 'Attendez un instant puis réessayez.',
	'categorytree-show-list'        => 'Afficher en liste',
	'categorytree-show-tree'        => 'Afficher en arborescence',
	'categorytree-too-many-subcats' => 'Les sous-catégories sont trop nombreuses pour être affichées sous forme d’arbre.',
);

/** Franco-Provençal (Arpetan)
 * @author ChrisPtDe
 * @author Siebrand
 */
$messages['frp'] = array(
	'categorytree'                  => 'Arborèscence de les catègories',
	'categorytree-tab'              => 'Âbro',
	'categorytree-desc'             => 'Outil basâ dessus AJAX por afichiér la [[Special:CategoryTree|structura de la catègorie]] d’un vouiqui',
	'categorytree-header'           => 'Entrâd un nom de catègorie por vêre son contegnu en structura arborèscenta.
Cen utilise des fonccionalitâts JavaScript avanciês cognues desot lo nom d’AJAX.
Se vos avéd un rudo viely navigator Malyâjo ou que vos éd pas activâ la fonccionalitât JavaScript, cen fonccionerat pas.',
	'categorytree-category'         => 'Catègorie:',
	'categorytree-go'               => 'Afichiér l’arborèscence',
	'categorytree-parents'          => 'Sur-catègorie(s) ',
	'categorytree-mode-categories'  => 'ren que les catègories',
	'categorytree-mode-pages'       => 'pâges sen les émâges',
	'categorytree-mode-all'         => 'totes les pâges',
	'categorytree-collapse'         => 'Recllôre',
	'categorytree-expand'           => 'Dèvelopar',
	'categorytree-load'             => 'Uvrir',
	'categorytree-loading'          => 'uvèrtura...',
	'categorytree-nothing-found'    => 'Pas trovâ, dèsolâ.',
	'categorytree-no-subcategories' => 'Gins de sot-catègorie.',
	'categorytree-no-pages'         => 'Gins d’articllo ou de sot-catègorie.',
	'categorytree-not-found'        => 'La catègorie <tt>$1</tt> at pas étâ trovâ.',
	'categorytree-error'            => 'Problèmo de chargement de les balyês.',
	'categorytree-retry'            => 'Atendéd un moment et pués tornâd èprovar.',
	'categorytree-show-list'        => 'Afichiér en lista',
	'categorytree-show-tree'        => 'Afichiér en arborèscence',
	'categorytree-too-many-subcats' => 'Les sot-catègories sont trop nombroses por étre afichiês desot fôrma d’âbro.',
);

/** Friulian (Furlan)
 * @author Klenje
 * @author Siebrand
 * @author MF-Warburg
 */
$messages['fur'] = array(
	'categorytree'                  => 'Arbul des categoriis',
	'categorytree-tab'              => 'Arbul',
	'categorytree-legend'           => 'Mostre arbul des categoriis',
	'categorytree-header'           => 'Inserìs il non de categorie di cui tu vuelis viodi i siei contignûts intune struture a arbul.
Cheste funzion e à bisugne di funzions avanzadis JavaScript, cognossudis come AJAX.
Se tu âs un sgarfadôr a vonde vieri, o tu âs disativât JavaScript, cheste pagjine no funzionarà.',
	'categorytree-category'         => 'Categorie:',
	'categorytree-go'               => 'Mostre arbul',
	'categorytree-mode-categories'  => 'mostre dome lis categoriis',
	'categorytree-mode-pages'       => 'dutis lis pagjinis, fûr che lis figuris',
	'categorytree-mode-all'         => 'dutis lis pagjinis',
	'categorytree-collapse'         => 'strenç',
	'categorytree-expand'           => 'slargje',
	'categorytree-load'             => 'cjame',
	'categorytree-loading'          => 'daûr a cjamâ',
	'categorytree-no-subcategories' => 'nissune sot categorie.',
	'categorytree-no-pages'         => 'nissune pagjine ni sotcategorie',
	'categorytree-show-list'        => 'Liste',
	'categorytree-show-tree'        => 'Arbul',
);

/** Irish (Gaeilge)
 * @author Alma
 * @author Xosé
 * @author Moilleadóir
 * @author Spacebirdy
 */
$messages['ga'] = array(
	'categorytree'                  => 'Crann na gCatagóirí',
	'categorytree-tab'              => 'Crann',
	'categorytree-legend'           => 'Taispeáin crann na gcatagóirí',
	'categorytree-desc'             => 'Giuirléid AJAX a thaispeánann an [[Special:CategoryTree|struchtúr catagóirí]] i vicí',
	'categorytree-header'           => 'Cuir isteach ainm catagóra chun a hinneachar a thaispeáint i struchtúr crainn.
Tabhair faoi deara gur riachtanach ardfheidhmiúlacht JavaScript (AJAX) a bheith agat.
Má tá do bhrabhsálaí róshean, nó má dhíchumasaigh tú JavaScript, ní oibreoidh sé.',
	'categorytree-category'         => 'Catagóir',
	'categorytree-go'               => 'Taispeán an Crann',
	'categorytree-parents'          => 'Máthairnóid',
	'categorytree-mode-categories'  => 'catagóirí amháin',
	'categorytree-mode-pages'       => 'leathanaigh seachas íomhánna',
	'categorytree-mode-all'         => 'gach leathanach',
	'categorytree-collapse'         => 'dún',
	'categorytree-expand'           => 'oscail',
	'categorytree-load'             => 'lódáil',
	'categorytree-loading'          => 'ag lódáil…',
	'categorytree-nothing-found'    => 'Ní bhfuarthas dada',
	'categorytree-no-subcategories' => 'gan fho-chatagóir',
	'categorytree-no-pages'         => 'gan leathanach ná fo-chatagóir',
	'categorytree-not-found'        => 'Ní bhfuarthas Catagóir <i>$1</i>',
	'categorytree-error'            => 'Earráid agus sonraí dá lódáil.',
	'categorytree-retry'            => 'Fan nóiméad, le do thoil, roimh triail eile a bhaint as.',
	'categorytree-show-list'        => 'Taispeáin mar liosta',
	'categorytree-show-tree'        => 'Taispeáin mar chrann',
	'categorytree-too-many-subcats' => 'Ní féidir na fo-chatagóirí a thaispeáint mar chrann, tá an iomarca díobh ann.',
);

/** Galician (Galego)
 * @author Alma
 * @author Toliño
 * @author Xosé
 * @author Siebrand
 */
$messages['gl'] = array(
	'categorytree'                  => 'Árbore de categorías',
	'categorytree-tab'              => 'Árbore',
	'categorytree-legend'           => 'Amosar a árbore de categorías',
	'categorytree-desc'             => 'Trebello baseado no AJAX para amosar a [[Special:CategoryTree|estrutura das categorías]] dun wiki',
	'categorytree-header'           => 'Introduza o nome dunha categoría para ver o contido da estrutura da árbore.
Déase conta de que se require a funcionalidade avanzada do JavaScript, coñecida como AJAX.
Se ten un navegador moi vello, ou deshabilitado para o JavaScript, non vai funcionar.',
	'categorytree-category'         => 'Categoría:',
	'categorytree-go'               => 'Amosar a árbore',
	'categorytree-parents'          => 'Nodos superiores',
	'categorytree-mode-categories'  => 'só categorías',
	'categorytree-mode-pages'       => 'páxinas agás imaxes',
	'categorytree-mode-all'         => 'todas as páxinas',
	'categorytree-collapse'         => 'contraer',
	'categorytree-expand'           => 'ampliar',
	'categorytree-load'             => 'cargar',
	'categorytree-loading'          => 'cargando…',
	'categorytree-nothing-found'    => 'nada atopado',
	'categorytree-no-subcategories' => 'non hai subcategorías',
	'categorytree-no-pages'         => 'non hai páxinas ou subcategorías',
	'categorytree-not-found'        => 'A categoría <i>"$1"</i> non foi atopada',
	'categorytree-error'            => 'Problema da carga de datos.',
	'categorytree-retry'            => 'Por favor, agarde un momento e ténteo de novo.',
	'categorytree-show-list'        => 'Amosar coma unha listaxe',
	'categorytree-show-tree'        => 'Amosar como unha árbore',
	'categorytree-too-many-subcats' => 'Non se poden amosar as subcategorías coma unha árbore, hai demasiadas.',
);

/** Gujarati (ગુજરાતી)
 * @author SPQRobin
 * @author Dsvyas
 */
$messages['gu'] = array(
	'categorytree-tab'           => 'વૃક્ષ',
	'categorytree-go'            => 'વૃક્ષ બતાવો',
	'categorytree-parents'       => 'પિતૃ',
	'categorytree-mode-all'      => 'બધા પાનાં',
	'categorytree-nothing-found' => 'કઈ ન મળ્યું',
	'categorytree-show-list'     => 'સૂચીના રૂપમાં',
	'categorytree-show-tree'     => 'વૃક્ષ રૂપમાં',
);

/** Manx (Gaelg)
 * @author MacTire02
 */
$messages['gv'] = array(
	'categorytree'                 => 'BilleyRonnaghyn',
	'categorytree-tab'             => 'Billey',
	'categorytree-legend'          => 'Billey ronnaghyn y haishbyney',
	'categorytree-category'        => 'Ronney:',
	'categorytree-go'              => 'Billey y haishbyney',
	'categorytree-mode-categories' => 'ronnaghyn ynrican',
	'categorytree-mode-all'        => 'dagh ooilley ghuillag',
	'categorytree-load'            => 'dy lughtaghey',
	'categorytree-loading'         => 'lughtaghey...',
);

/** Hakka (Hak-kâ-fa)
 * @author Hakka
 * @author Siebrand
 */
$messages['hak'] = array(
	'categorytree'          => 'Fûn-lui-su',
	'categorytree-category' => 'Fûn-lui:',
	'categorytree-expand'   => 'Chán-khôi',
);

/** Hebrew (עברית) */
$messages['he'] = array(
	'categorytree'                  => 'עץ קטגוריות',
	'categorytree-tab'              => 'עץ',
	'categorytree-legend'           => 'הצגת עץ קטגוריות',
	'categorytree-desc'             => 'כלי מבוסס AJAX להצגת [[Special:CategoryTree|מבנה הקטגוריות]] של אתר ויקי',
	'categorytree-header'           => 'הקלידו שם קטגוריה כדי לראות את תכניה במבנה עץ. שימו לב שהדבר דורש תכונת JavaScript מתקדמת, הידועה בשם AJAX. אם יש לכם דפדפן ישן מאוד, או ש־JavaScript מנוטרלת אצלכם בדפדפן, הוא לא יעבוד.',
	'categorytree-category'         => 'קטגוריה',
	'categorytree-go'               => 'הצגת העץ',
	'categorytree-parents'          => 'הורים',
	'categorytree-mode-categories'  => 'קטגוריות בלבד',
	'categorytree-mode-pages'       => 'דפים שאינם תמונות',
	'categorytree-mode-all'         => 'כל הדפים',
	'categorytree-collapse'         => 'כיווץ',
	'categorytree-expand'           => 'הרחבה',
	'categorytree-load'             => 'טעינה',
	'categorytree-loading'          => 'בטעינה',
	'categorytree-nothing-found'    => 'לא נמצאו תוצאות',
	'categorytree-no-subcategories' => 'אין קטגוריות משנה',
	'categorytree-no-pages'         => 'אין דפים או קטגוריות משנה',
	'categorytree-not-found'        => "הקטגוריה '''$1''' לא נמצאה",
	'categorytree-error'            => 'בעיה בטעינת המידע.',
	'categorytree-retry'            => 'אנא המתינו מעט ונסו שנית.',
	'categorytree-show-list'        => 'תצוגת רשימה',
	'categorytree-show-tree'        => 'תצוגת עץ',
	'categorytree-too-many-subcats' => 'לא ניתן להציג את קטגוריות המשנה כעץ כיוון שהן מרובות מדי.',
);

/** Hindi (हिन्दी)
 * @author Kaustubh
 */
$messages['hi'] = array(
	'categorytree'                  => 'श्रेणीवृक्ष',
	'categorytree-tab'              => 'वृक्ष',
	'categorytree-legend'           => 'श्रेणीवृक्ष दिखायें',
	'categorytree-desc'             => 'विकिकी [[Special:CategoryTree|श्रेणीयाँ]] दिखानेके लिये AJAX से बना औज़ार',
	'categorytree-header'           => 'एक श्रेणीके कन्टेन्ट्स वृक्ष के रूपमें देखने के लिये उसका नाम दें।
इस सुविधाके लिये AJAX नाम के एक जावास्क्रीप्ट की जरुरत होती हैं, इसपर ध्यान दें।
अगर आपका ब्राउज़र बहुत पुराना हैं, या जावास्क्रीप्ट बंद रखी हुई हैं तो यह काम नहीं करेगा।',
	'categorytree-category'         => 'श्रेणी:',
	'categorytree-go'               => 'वृक्ष दिखायें',
	'categorytree-parents'          => 'पालक',
	'categorytree-mode-categories'  => 'सिर्फ श्रेणीयाँ',
	'categorytree-mode-pages'       => 'चित्र ना होने वाले पन्ने',
	'categorytree-mode-all'         => 'सभी पन्ने',
	'categorytree-collapse'         => 'छोटा करें',
	'categorytree-expand'           => 'बडा करें',
	'categorytree-load'             => 'लोड करें',
	'categorytree-loading'          => 'लोड कर रहें हैं...',
	'categorytree-nothing-found'    => 'कुछ भी मिला नहीं',
	'categorytree-no-subcategories' => 'उपश्रेणीयाँ नहीं हैं',
	'categorytree-no-pages'         => 'लेख या उपश्रेणीयाँ नहीं हैं',
	'categorytree-not-found'        => 'श्रेणी <i>$1</i> मिली नहीं',
	'categorytree-error'            => 'डाटा लोड करने में समस्या।',
	'categorytree-retry'            => 'कृपया थोडे समय के बाद फिरसे यत्न करें।',
	'categorytree-show-list'        => 'सूची दर्शायें',
	'categorytree-show-tree'        => 'वृक्ष दर्शायें',
	'categorytree-too-many-subcats' => 'उपश्रेणियाँ वृक्ष के रूप में नहीं दिखा पा रहें हैं, क्योंकि वे बहुत ज्यादा हैं।',
);

/** Croatian (Hrvatski)
 * @author SpeedyGonsales
 * @author Suradnik13
 */
$messages['hr'] = array(
	'categorytree'                  => 'Stablasti prikaz hijerarhije kategorija',
	'categorytree-tab'              => 'Stablo',
	'categorytree-legend'           => 'Prikaži stablo kategorija',
	'categorytree-header'           => 'Upišite ime kategorije da biste vidjeli njen položaj u stablastom prikazu hijerarhije. Napomena: na strani klijenta (na Vašem računalu) potreban je web preglednik koji podržava napredni JavaScript, tj. AJAX. Ukoliko imate stari web preglednik, ili ste onemogućili izvođenje JavaScripta u njemu, neće Vam biti dostupan ovaj prikaz.',
	'categorytree-category'         => 'Kategorija',
	'categorytree-go'               => 'Učitaj',
	'categorytree-parents'          => 'Rodne kategorije',
	'categorytree-mode-categories'  => 'pokaži samo kategorije',
	'categorytree-mode-pages'       => 'pokaži kategorije i stranice (bez slika)',
	'categorytree-mode-all'         => 'sve stranice',
	'categorytree-collapse'         => 'sklopi stablo',
	'categorytree-expand'           => 'raširi stablo (expand)',
	'categorytree-load'             => 'učitaj',
	'categorytree-loading'          => 'učitavam',
	'categorytree-nothing-found'    => 'Nije pronađena nijedna stavka.',
	'categorytree-no-subcategories' => 'Nema potkategorija.',
	'categorytree-no-pages'         => 'Nema članaka ili potkategorija.',
	'categorytree-not-found'        => 'Kategorija <i>$1</i> nije nađena',
	'categorytree-error'            => 'Problem s učitavanjem podataka.',
	'categorytree-retry'            => 'Pričekajte trenutak pa pokušajte opet.',
	'categorytree-show-list'        => 'Prikaži kao popis',
	'categorytree-show-tree'        => 'Prikaži kao stablo',
	'categorytree-too-many-subcats' => 'Ne mogu prikazati podkategorije kao stablo, previše ih je.',
);

/** Upper Sorbian (Hornjoserbsce)
 * @author Siebrand
 * @author Michawiki
 */
$messages['hsb'] = array(
	'categorytree'                  => 'Kategorijowy štom',
	'categorytree-tab'              => 'Štom',
	'categorytree-legend'           => 'Kategorijowy štom pokazać',
	'categorytree-desc'             => 'Přisłušk (gadget) na zakładźe AJAX za [[Special:CategoryTree|zwobraznjenje struktury]] wikija',
	'categorytree-header'           => 'Zapisaj mjeno kategorije, zo by jeje wobsah jako štomowu strukturu widźał. Wobkedźbuj, zo su za to wěste JavaScriptowe funkcije (AJAX) trjeba. Jeli maš jara stary wobhladowak abo jeli JavaScript je wupinjeny, to snano njebudźe fungować.',
	'categorytree-category'         => 'Kategorija',
	'categorytree-go'               => 'Štom pokazać',
	'categorytree-parents'          => 'Nadkategorije',
	'categorytree-mode-categories'  => 'jenož kategorije',
	'categorytree-mode-pages'       => 'strony nimo wobrazow',
	'categorytree-mode-all'         => 'wšě strony',
	'categorytree-collapse'         => 'schować',
	'categorytree-expand'           => 'pokazać',
	'categorytree-load'             => 'začitać',
	'categorytree-loading'          => 'čita so…',
	'categorytree-nothing-found'    => 'ničo namakane',
	'categorytree-no-subcategories' => 'žane podkategorije',
	'categorytree-no-pages'         => 'žane strony abo podkategorije',
	'categorytree-not-found'        => "Kategorija ''$1'' njenamakana",
	'categorytree-error'            => 'Problem při čitanju datow.',
	'categorytree-retry'            => 'Prošu čakaj wokomik a spytaj potom hišće raz.',
	'categorytree-show-list'        => 'Jako lisćinu zwobraznić',
	'categorytree-show-tree'        => 'Jako štom zwobraznić',
	'categorytree-too-many-subcats' => 'Njemóžno podkategorije jako štom zwobraznić, je přewjele z nich',
);

/** Haitian (Kreyòl ayisyen)
 * @author Masterches
 */
$messages['ht'] = array(
	'categorytree'                  => 'Òganizasyon kategori yo',
	'categorytree-tab'              => 'Kategori, pyebwa òganizasyon',
	'categorytree-legend'           => 'Montre òganizasyon pou kategori a',
	'categorytree-desc'             => 'Jwèt, gadjèt sòti nan AJAX pou montre [[Special:CategoryTree|òganizasyon kategori ]] yon wiki.',
	'categorytree-header'           => 'Antre non yon kategori pou wè sa l genyen anndan l, òganizasyon l.
Tande byen ke sa mande fonksyon JavaScript ki gen wo nivo tankou AJAX.
Si ou ta genyen yon vye navigatè (navigatè, bwozè entènèt), oubyen JavaScript pa aktive, li pe ke mache byen.',
	'categorytree-category'         => 'Kategori:',
	'categorytree-go'               => 'Montre òganizasyon, estrikti',
	'categorytree-parents'          => 'Papa ak manman',
	'categorytree-mode-categories'  => 'Kategori yo sèlman',
	'categorytree-mode-pages'       => 'paj san imaj, retire tout imaj nan paj an',
	'categorytree-mode-all'         => 'tout paj yo',
	'categorytree-collapse'         => 'fème tout seksyon yo',
	'categorytree-expand'           => 'Elaji seksyon an',
	'categorytree-load'             => 'Chaje, ouvri',
	'categorytree-loading'          => 'ap chaje...',
	'categorytree-nothing-found'    => 'nou pa twouve anyen ki ap koresponn',
	'categorytree-no-subcategories' => 'kategori sa pa gen pitit, pa gen kategori pi ba.',
	'categorytree-no-pages'         => 'pa gen paj oubyen atik oubyen kategori pi ba',
	'categorytree-not-found'        => 'Nou pa twouve kategori <i>$1</i>',
	'categorytree-error'            => 'Pwoblèm lè nou tap chaje, ouvri done yo.',
	'categorytree-retry'            => 'Souple, rete yon enstan, yon moman epi eseye ankò.',
	'categorytree-show-list'        => 'Montre nan yon lis eleman, yonn anba lòt',
	'categorytree-show-tree'        => 'Montre tankou yon pyebwa, fèy yo ak depann de yon branch',
	'categorytree-too-many-subcats' => 'Kategori pi piti yo twòp, nou pa kapab afiche yo tankou pyebwa.',
);

/** Hungarian (Magyar)
 * @author KossuthRad
 * @author Dani
 */
$messages['hu'] = array(
	'categorytree'                  => 'Kategóriafa',
	'categorytree-tab'              => 'Fa',
	'categorytree-legend'           => 'Mutatsd faként',
	'categorytree-desc'             => 'AJAX alapú eszköz a wiki [[Special:CategoryTree|kategória-struktúrájának]] megjelenítéséhez',
	'categorytree-header'           => 'Add meg annak a kategóriának a nevét, amelynek meg szeretnéd tekinteni
a fastruktúráját. Ehhez egy, AJAX nevű JavaScript-technológia szükséges.
Ha túlságosan régi böngésződ van, vagy a JavaScript le van tiltva, akkor nem fog működni.',
	'categorytree-category'         => 'Kategória',
	'categorytree-go'               => 'Mehet',
	'categorytree-parents'          => 'Szülő kategóriák',
	'categorytree-mode-categories'  => 'csak kategóriák',
	'categorytree-mode-pages'       => 'oldalak kivéve képek',
	'categorytree-mode-all'         => 'Az összes oldal',
	'categorytree-collapse'         => 'összecsuk',
	'categorytree-expand'           => 'kinyit',
	'categorytree-load'             => 'Töltés',
	'categorytree-loading'          => 'töltés',
	'categorytree-nothing-found'    => 'nincs találat',
	'categorytree-no-subcategories' => 'nincs alkategória.',
	'categorytree-no-pages'         => 'nincs cikk vagy alkategória.',
	'categorytree-not-found'        => 'Kategória <i>$1</i> nem található',
	'categorytree-error'            => 'Probélma a betöltődő adattal',
	'categorytree-retry'            => 'Kérlek várj egy pillanatot és próbáld újra.',
	'categorytree-show-list'        => 'Mutatsd listaként',
	'categorytree-show-tree'        => 'Mutatsd faként',
	'categorytree-too-many-subcats' => 'Az alkategóriák nem jeleníthetőek meg, mert túl sok van belőlük.',
);

/** Armenian (Հայերեն)
 * @author Teak
 */
$messages['hy'] = array(
	'categorytree'                  => 'Կատեգորիաների ծառ',
	'categorytree-tab'              => 'Ծառ',
	'categorytree-header'           => 'Մուտքագրեք կատեգորիայի անունը` ծառի համակարգը տեսնելու համար։
Ի նկատի ունեցեք, որ սա հնարավոր է միայն ձեր բրաուզերի կողմից AJAX-ի ֆունկցիանալության դեպքում։
Եթե դուք աշխատում եք շատ հին բրաուզերով, կամ ձեր JavaScript-ը անջատված է` այն չի գործի։',
	'categorytree-category'         => 'Կատեգորիա.',
	'categorytree-go'               => 'Ցույց տալ ծառը',
	'categorytree-parents'          => 'Ծնողներ',
	'categorytree-mode-categories'  => 'միայն կատեգորիաները',
	'categorytree-mode-pages'       => 'բացի պատկերներից',
	'categorytree-mode-all'         => 'բոլոր էջերը',
	'categorytree-collapse'         => 'փակել',
	'categorytree-expand'           => 'բացել',
	'categorytree-load'             => 'բեռնել',
	'categorytree-loading'          => 'բեռնվում է',
	'categorytree-nothing-found'    => 'ենթակատեգորիան չկան',
	'categorytree-no-subcategories' => 'ենթակատեգորիաներ չկան',
	'categorytree-no-pages'         => 'ենթակատեգորիան և էջեր չկան',
	'categorytree-not-found'        => '«<i>$1</i>» կատեգորիան չի գտնվել',
	'categorytree-error'            => 'Տվյալների բեռնումը չհաջողվեց',
	'categorytree-retry'            => 'Խնդրում ենք սպասել մեկ ակնթարթ և փորձել կրկին։',
	'categorytree-show-list'        => 'Ցանկի տեսքով',
	'categorytree-show-tree'        => 'Ծառի տեսքով',
	'categorytree-too-many-subcats' => 'Հնարավոր չէ ցուցադրել ենթակատեգորիաները ծառի տեսքով՝ չափից շատ են։',
);

/** Interlingua (Interlingua)
 * @author Malafaya
 */
$messages['ia'] = array(
	'categorytree-tab'      => 'Arbore',
	'categorytree-category' => 'Categoria:',
	'categorytree-mode-all' => 'tote le paginas',
);

/** Indonesian (Bahasa Indonesia)
 * @author IvanLanin
 * @author Rex
 */
$messages['id'] = array(
	'categorytree'                  => 'Pohon kategori',
	'categorytree-tab'              => 'Pohon',
	'categorytree-legend'           => 'Tampilkan pohon kategori',
	'categorytree-desc'             => 'Gadget berbasis AJAX untuk menampilkan [[Special:CategoryTree|struktur kategori]] suatu wiki',
	'categorytree-header'           => 'Masukkan suatu nama kategori untuk melihat isinya dalam bentuk pohon.
Harap diperhatikan bahwa fitur ini memerlukan dukungan JavaScript tingkat lanjut yang dikenal sebagai AJAX.
Jika Anda menggunakan penjelajah web lama, atau mematikan fungsi JavaScript Anda, fitur ini tidak dapat dijalankan.',
	'categorytree-category'         => 'Kategori',
	'categorytree-go'               => 'Tampilkan',
	'categorytree-parents'          => 'Atasan',
	'categorytree-mode-categories'  => 'hanya kategori',
	'categorytree-mode-pages'       => 'halaman kecuali berkas',
	'categorytree-mode-all'         => 'semua halaman',
	'categorytree-collapse'         => 'tutup',
	'categorytree-expand'           => 'buka',
	'categorytree-load'             => 'muat',
	'categorytree-loading'          => 'memuat',
	'categorytree-nothing-found'    => 'tidak ditemukan',
	'categorytree-no-subcategories' => 'tidak ada subkategori',
	'categorytree-no-pages'         => 'tidak ada halaman atau subkategori',
	'categorytree-not-found'        => 'Kategori <i>$1</i> tidak ditemukan',
	'categorytree-error'            => 'Problem memuat data.',
	'categorytree-retry'            => 'Tunggulah sesaat dan coba lagi.',
	'categorytree-show-list'        => 'Tampilkan daftar',
	'categorytree-show-tree'        => 'Tampilkan pohon',
	'categorytree-too-many-subcats' => 'Tidak dapat menampilkan subkategori dalam bentuk pohon karena jumlahnya terlalu banyak.',
);

/** Interlingue (Interlingue)
 * @author Malafaya
 */
$messages['ie'] = array(
	'categorytree-category' => 'Categorie:',
);

/** Ido (Ido)
 * @author Malafaya
 * @author Siebrand
 */
$messages['io'] = array(
	'categorytree-tab'              => 'Arboro',
	'categorytree-category'         => 'Kategorio:',
	'categorytree-go'               => 'Montrar Arboro',
	'categorytree-mode-categories'  => 'nur kategorii',
	'categorytree-mode-all'         => 'omna pagini',
	'categorytree-no-subcategories' => 'nula subkategorii',
	'categorytree-no-pages'         => 'nula pagini o subkategorii',
);

/** Icelandic (Íslenska)
 * @author S.Örvarr.S
 * @author Spacebirdy
 * @author Siebrand
 */
$messages['is'] = array(
	'categorytree'                  => 'Flokkatré',
	'categorytree-tab'              => 'Tré',
	'categorytree-legend'           => 'Sýna flokkatré',
	'categorytree-header'           => 'Sláðu inn heiti flokks til að sjá innihald hans sem tré.
Hafðu í huga að þetta krefst þróaðra virkni JavaScript sem nefnist AJAX.
Ef þú notast við gamlan vafra eða hefur slökkt á JavaScript mun þetta ekki virka.',
	'categorytree-category'         => 'Flokkur:',
	'categorytree-go'               => 'Sýna tré',
	'categorytree-parents'          => 'Undirrætur',
	'categorytree-mode-categories'  => 'bara flokka',
	'categorytree-mode-pages'       => 'síður að myndum undanskildum',
	'categorytree-mode-all'         => 'allar síður',
	'categorytree-collapse'         => 'fela',
	'categorytree-expand'           => 'sýna',
	'categorytree-load'             => 'hlaða',
	'categorytree-loading'          => 'hleð',
	'categorytree-nothing-found'    => 'ekkert fannst',
	'categorytree-no-subcategories' => 'engir undirflokkar',
	'categorytree-no-pages'         => 'engar síður eða undirflokkar',
	'categorytree-not-found'        => 'Flokkurinn <i>$1</i> fannst ekki',
	'categorytree-error'            => 'Villa við hleðslu gagna.',
	'categorytree-retry'            => 'Gjörðu svo vel og reyndu síðar.',
	'categorytree-show-list'        => 'Sýna sem lista',
	'categorytree-show-tree'        => 'Sýna sem tré',
	'categorytree-too-many-subcats' => 'Get ekki sýnt undirflokka sem tré, þeir eru of margir.',
);

/** Italian (Italiano)
 * @author .anaconda
 * @author BrokenArrow
 * @author Gianfranco
 */
$messages['it'] = array(
	'categorytree'                  => 'Struttura ad albero delle categorie',
	'categorytree-tab'              => 'Albero',
	'categorytree-desc'             => 'Accessorio AJAX per visualizzare la [[Special:CategoryTree|struttura delle categorie]] del sito',
	'categorytree-header'           => 'Inserire il nome della categoria di cui si desidera vedere il contenuto sotto forma di struttura ad albero. Si noti che la pagina richiede le funzionalità avanzate di JavaScript chiamate AJAX; qualora si stia usando un browser molto vecchio o le funzioni JavaScript siano disabilitate, questa pagina non funzionerà.',
	'categorytree-category'         => 'Categoria',
	'categorytree-go'               => 'Carica',
	'categorytree-parents'          => 'Categorie superiori',
	'categorytree-mode-categories'  => 'mostra solo le categorie',
	'categorytree-mode-pages'       => 'tutte le pagine, escluse le immagini',
	'categorytree-mode-all'         => 'tutte le pagine',
	'categorytree-collapse'         => 'comprimi',
	'categorytree-expand'           => 'espandi',
	'categorytree-load'             => 'carica',
	'categorytree-loading'          => 'caricamento in corso',
	'categorytree-nothing-found'    => 'nessun risultato',
	'categorytree-no-subcategories' => 'nessuna sottocategoria.',
	'categorytree-no-pages'         => 'nessuna voce né sottocategoria.',
	'categorytree-not-found'        => "Categoria  ''$1'' non trovata",
	'categorytree-error'            => 'Problema nel caricamento dei dati.',
	'categorytree-retry'            => 'Attendere un momento e riprovare.',
	'categorytree-show-list'        => 'Lista',
	'categorytree-show-tree'        => 'Struttura ad albero',
	'categorytree-too-many-subcats' => 'Le sottocategorie sono troppe per essere visualizzate sotto forma di struttura ad albero.',
);

/** Japanese (日本語)
 * @author Kahusi
 * @author Broad-Sky
 * @author JtFuruhata
 */
$messages['ja'] = array(
	'categorytree'                  => 'カテゴリツリー',
	'categorytree-tab'              => 'ツリー',
	'categorytree-desc'             => 'ウィキの[[Special:CategoryTree|カテゴリツリー]]を表示する、AJAXベースのガジェット',
	'categorytree-header'           => 'カテゴリの中身をツリー構造としてを見るために、そのカテゴリ名を入力してください。この機能は、Ajaxとして知られているJavaScriptを使用していることに注意してください。もしあなたが使っているブラウザが非常に古かったり、JavaScriptを有効にしていないのであれば、動作しません。',
	'categorytree-category'         => 'カテゴリ名: ',
	'categorytree-go'               => 'ツリーを見る',
	'categorytree-parents'          => '上位カテゴリ',
	'categorytree-mode-categories'  => 'カテゴリのみ',
	'categorytree-mode-pages'       => '画像以外の全ページ',
	'categorytree-mode-all'         => 'すべてのページ',
	'categorytree-collapse'         => '下位カテゴリを非表示',
	'categorytree-expand'           => '下位カテゴリを再表示',
	'categorytree-load'             => '下位カテゴリを表示',
	'categorytree-loading'          => '読み込み中',
	'categorytree-nothing-found'    => '存在しません',
	'categorytree-no-subcategories' => 'サブカテゴリはありません',
	'categorytree-no-pages'         => 'ページやサブカテゴリはありません',
	'categorytree-not-found'        => 'カテゴリ " <i>$1</i> " はありません',
	'categorytree-error'            => 'データの読み込み中に問題が発生しました',
	'categorytree-retry'            => '暫く経った後に再度試してください。',
	'categorytree-show-list'        => '一覧で表示',
	'categorytree-show-tree'        => 'ツリー形式で表示',
	'categorytree-too-many-subcats' => 'サブカテゴリの数が多すぎるため、ツリー表示できません。',
);

/** Jutish (Jysk)
 * @author Huslåke
 * @author Siebrand
 */
$messages['jut'] = array(
	'categorytree'                  => 'Klyngetræ',
	'categorytree-tab'              => 'Træ',
	'categorytree-desc'             => 'AJAX based gadget til display a [[Special:CategoryTree|klynge struktur]] ener wiki',
	'categorytree-header'           => "Indtast navnet på en kategori for at se indholdet som et træ. Bemærk at dette kræver avanceret JavaScript-funktionalitet kendt som AJAX, det verker ig'n hves du harst en meget gammel browser zller hves du harst slået JavaScript frå.",
	'categorytree-category'         => 'Klynge:',
	'categorytree-go'               => 'Henter',
	'categorytree-parents'          => 'Åverklynger',
	'categorytree-mode-categories'  => 'ves kun klynger',
	'categorytree-mode-pages'       => 'sider undtaget billeter',
	'categorytree-mode-all'         => 'ål sider',
	'categorytree-collapse'         => 'fold sammen',
	'categorytree-expand'           => 'fold ud',
	'categorytree-load'             => 'hent',
	'categorytree-loading'          => 'endlæser',
	'categorytree-nothing-found'    => "Ig'n funder, desvære.",
	'categorytree-no-subcategories' => "Ig'n underklynger.",
	'categorytree-no-pages'         => "Ig'n ertikler æller underklynger.",
	'categorytree-not-found'        => "Æ klynge ''$1'' blev ekke fundet",
	'categorytree-error'            => 'Der åpstød et pråblæm under endlæsnenge åf data.',
	'categorytree-retry'            => 'Vent et øjeblek og prøv egen.',
	'categorytree-show-list'        => 'Ves søm liste.',
	'categorytree-show-tree'        => 'Ves søm træ',
	'categorytree-too-many-subcats' => 'Ken ekke vese underklynger søm træ, der er før mange.',
);

/** Javanese (Basa Jawa)
 * @author Meursault2004
 */
$messages['jv'] = array(
	'categorytree'                  => 'Uwit kategori',
	'categorytree-tab'              => 'Uwit',
	'categorytree-legend'           => 'Tuduhna uwit kategori',
	'categorytree-desc'             => 'Gadget adhedhasar AJAX kanggo nuduhaké [[Special:CategoryTree|struktur kategori]] sawijining wiki',
	'categorytree-header'           => 'Lebokna sawijining jeneng kategori kanggo deleng isiné minangka sawijining wujud uwit.
Mangga diwigatèkaké yèn fitur iki merlokaké fungsionalitas JavaScript canggih sing diarani AJAX.
Menawa panjenengan panjlajah wèbé kalebu vèrsi lawa, utawa fitur JavaScript dipatèni, fungsi iki ora bisa dilakokaké.',
	'categorytree-category'         => 'Kategori:',
	'categorytree-go'               => 'Tuduhna uwit',
	'categorytree-parents'          => 'Kategori sing luwih dhuwur',
	'categorytree-mode-categories'  => 'kategori waé',
	'categorytree-mode-pages'       => 'kaca-kaca kejaba gambar-gambar',
	'categorytree-mode-all'         => 'kabèh kaca',
	'categorytree-collapse'         => 'ciyutna',
	'categorytree-expand'           => 'ambakna',
	'categorytree-load'             => 'unggah',
	'categorytree-loading'          => 'ngunggahaké…',
	'categorytree-nothing-found'    => 'ora ditemokaké',
	'categorytree-no-subcategories' => 'ora ana subkategori',
	'categorytree-no-pages'         => 'ora ana kaca utawa subkategori',
	'categorytree-not-found'        => 'Kategori <i>$1</i> ora ditemokaké',
	'categorytree-error'            => 'Ana masalah ngunggahaké data.',
	'categorytree-retry'            => 'Tulung ditunggu sadélok lan dicoba manèh.',
	'categorytree-show-list'        => 'Tuduhna minangka daftar',
	'categorytree-show-tree'        => 'Tuduhna minangka uwit',
	'categorytree-too-many-subcats' => 'Ora bisa nuduhaké subkategori minangka uwit, amerga cacahé kakèhan.',
);

/** Georgian (ქართული)
 * @author Malafaya
 */
$messages['ka'] = array(
	'categorytree-tab'      => 'ხე',
	'categorytree-category' => 'კატეგორია:',
	'categorytree-go'       => 'ხის ჩვენება',
	'categorytree-mode-all' => 'ყველა გვერდი',
);

/** Kara-Kalpak (Qaraqalpaqsha)
 * @author AlefZet
 */
$messages['kaa'] = array(
	'categorytree' => 'Kategoriyalar teregi',
);

/** Kazakh (Arabic script) (‫قازاقشا (تٴوتە)‬) */
$messages['kk-arab'] = array(
	'categorytree'                  => 'سانات بۇتاقتارى',
	'categorytree-tab'              => 'بۇتاقتار',
	'categorytree-header'           => 'سانات مازمۇنىڭ بۇتاقتار تۇردە كورۋ ٴۇشىن اتاۋىن ەنگىزىڭىز.
اڭعارپتا: بۇل ىسكە JavaScript قۇرالىنىڭ AJAX دەگەن كەڭەيتىلگەن قابىلەتى قاجەت بولادى.
ەگەر شولعىشىڭىز وتە ەسكى, نەمەسە JavaScript وشىرىلگەن بولسا, بۇل ىسكە اسىرىلمايدى.',
	'categorytree-category'         => 'سانات',
	'categorytree-go'               => 'بۇتاقتارىن كورسەت',
	'categorytree-parents'          => 'جوعارعىلار',
	'categorytree-mode-categories'  => 'تەك ساناتتار',
	'categorytree-mode-pages'       => 'بەتتەر (سۋرەتتەردى ساناماي)',
	'categorytree-mode-all'         => 'بارلىق بەت',
	'categorytree-collapse'         => 'تارىلتۋ',
	'categorytree-expand'           => 'كەڭەيتۋ',
	'categorytree-load'             => 'جۇكتەۋ',
	'categorytree-loading'          => 'جۇكتەۋدە',
	'categorytree-nothing-found'    => 'ەشتەڭە تابىلمادى',
	'categorytree-no-subcategories' => 'ساناتشالارى جوق',
	'categorytree-no-pages'         => 'بەتتەرى نە ساناتشالارى جوق',
	'categorytree-not-found'        => '<i>$1</i> دەگەن سانات تابىلمادى',
	'categorytree-error'            => 'دەرەكتەردى جۇكتەۋ كەزىندە شاتاق شىقتى.',
	'categorytree-retry'            => 'ٴبىر ٴسات كۇتە تۇرىپ قايتالاڭىز.',
	'categorytree-show-list'        => 'تىزىمشە كورسەت',
	'categorytree-show-tree'        => 'بۇتاقتارشا كورسەت',
	'categorytree-too-many-subcats' => 'ساناتشالار تىم كوپ بولعاندىقتان, بۇتاقتارى كورسەتىلمەيدى.',
);

/** Kazakh (Cyrillic) (Қазақша (Cyrillic)) */
$messages['kk-cyrl'] = array(
	'categorytree'                  => 'Санат бұтақтары',
	'categorytree-tab'              => 'Бұтақтар',
	'categorytree-header'           => 'Санат мазмұның бұтақтар түрде көру үшін атауын енгізіңіз.
Аңғарпта: Бұл іске JavaScript құралының AJAX деген кеңейтілген қабілеті қажет болады.
Егер шолғышыңыз өте ескі, немесе JavaScript өшірілген болса, бұл іске асырылмайды.',
	'categorytree-category'         => 'Санат',
	'categorytree-go'               => 'Бұтақтарын көрсет',
	'categorytree-parents'          => 'Жоғарғылар',
	'categorytree-mode-categories'  => 'тек санаттар',
	'categorytree-mode-pages'       => 'беттер (суреттерді санамай)',
	'categorytree-mode-all'         => 'барлық бет',
	'categorytree-collapse'         => 'тарылту',
	'categorytree-expand'           => 'кеңейту',
	'categorytree-load'             => 'жүктеу',
	'categorytree-loading'          => 'жүктеуде',
	'categorytree-nothing-found'    => 'ештеңе табылмады',
	'categorytree-no-subcategories' => 'санатшалары жоқ',
	'categorytree-no-pages'         => 'беттері не санатшалары жоқ',
	'categorytree-not-found'        => '<i>$1</i> деген санат табылмады',
	'categorytree-error'            => 'Деректерді жүктеу кезінде шатақ шықты.',
	'categorytree-retry'            => 'Бір сәт күте тұрып қайталаңыз.',
	'categorytree-show-list'        => 'Тізімше көрсет',
	'categorytree-show-tree'        => 'Бұтақтарша көрсет',
	'categorytree-too-many-subcats' => 'Санатшалар тым көп болғандықтан, бұтақтары көрсетілмейді.',
);

/** Kazakh (Latin) (Қазақша (Latin)) */
$messages['kk-latn'] = array(
	'categorytree'                  => 'Sanat butaqtarı',
	'categorytree-tab'              => 'Butaqtar',
	'categorytree-header'           => 'Sanat mazmunıñ butaqtar türde körw üşin atawın engiziñiz.
Añğarpta: Bul iske JavaScript quralınıñ AJAX degen keñeýtilgen qabileti qajet boladı.
Eger şolğışıñız öte eski, nemese JavaScript öşirilgen bolsa, bul iske asırılmaýdı.',
	'categorytree-category'         => 'Sanat',
	'categorytree-go'               => 'Butaqtarın körset',
	'categorytree-parents'          => 'Joğarğılar',
	'categorytree-mode-categories'  => 'tek sanattar',
	'categorytree-mode-pages'       => 'better (swretterdi sanamaý)',
	'categorytree-mode-all'         => 'barlıq bet',
	'categorytree-collapse'         => 'tarıltw',
	'categorytree-expand'           => 'keñeýtw',
	'categorytree-load'             => 'jüktew',
	'categorytree-loading'          => 'jüktewde',
	'categorytree-nothing-found'    => 'eşteñe tabılmadı',
	'categorytree-no-subcategories' => 'sanatşaları joq',
	'categorytree-no-pages'         => 'betteri ne sanatşaları joq',
	'categorytree-not-found'        => '<i>$1</i> degen sanat tabılmadı',
	'categorytree-error'            => 'Derekterdi jüktew kezinde şataq şıqtı.',
	'categorytree-retry'            => 'Bir sät küte turıp qaýtalañız.',
	'categorytree-show-list'        => 'Tizimşe körset',
	'categorytree-show-tree'        => 'Butaqtarşa körset',
	'categorytree-too-many-subcats' => 'Sanatşalar tım köp bolğandıqtan, butaqtarı körsetilmeýdi.',
);

/** Khmer (ភាសាខ្មែរ)
 * @author Lovekhmer
 * @author Chhorran
 * @author គីមស៊្រុន
 * @author Siebrand
 */
$messages['km'] = array(
	'categorytree'                  => 'មែកធាងនៃចំណាត់ថ្នាក់ក្រុម',
	'categorytree-tab'              => 'មែកធាង',
	'categorytree-legend'           => 'បង្ហាញមែកធាងចំនាត់ថ្នាក់ក្រុម',
	'categorytree-category'         => 'ចំណាត់ថ្នាក់ក្រុម:',
	'categorytree-go'               => 'បង្ហាញដើមឈើ',
	'categorytree-parents'          => 'ចំណាត់ថ្នាក់ក្រុមកំរិតខ្ពស់',
	'categorytree-mode-categories'  => 'សំរាប់តែចំណាត់ថ្នាក់ក្រុមប៉ុណ្ណោះ',
	'categorytree-mode-pages'       => 'ទំព័រលើកលែងតែរូបភាព',
	'categorytree-mode-all'         => 'គ្រប់ទំព័រ',
	'categorytree-collapse'         => 'បង្រួម',
	'categorytree-expand'           => 'ពន្លាត',
	'categorytree-load'             => 'ផ្ទុក',
	'categorytree-loading'          => 'កំពុងផ្ទុក',
	'categorytree-nothing-found'    => 'រកមិនឃើញអ្វី',
	'categorytree-no-subcategories' => 'មិនមានចំនាត់ថ្នាក់ក្រុមរងទេ',
	'categorytree-no-pages'         => 'មិនមានទំព័រឬចំនាត់ថ្នាក់ក្រុមរងទេ',
	'categorytree-not-found'        => 'រកមិនឃើញចំនាត់ថ្នាក់ក្រុម <i>$1</i> ទេ',
	'categorytree-error'            => 'មានបញ្ហា ផ្ទុកទិន្នន័យ។',
	'categorytree-retry'            => 'ចាំមួយភ្លែត សឹម ព្យាយាមម្តងទៀត ។',
	'categorytree-show-list'        => 'បង្ហាញជាបញ្ជី',
	'categorytree-show-tree'        => 'បង្ហាញជាមែកធាង',
	'categorytree-too-many-subcats' => 'មិនអាចបង្ហាញ ចំណាត់ក្រុមរង ជា ដើមឈើ, វាមានចំណាត់ក្រុមរង ច្រើនពេក ។',
);

/** Korean (한국어)
 * @author Klutzy
 * @author Siebrand
 * @author ToePeu
 */
$messages['ko'] = array(
	'categorytree'                  => '분류 트리',
	'categorytree-tab'              => '트리',
	'categorytree-legend'           => '분류 트리 보기',
	'categorytree-desc'             => '위키의 [[Special:CategoryTree|분류 구조]]를 볼 수 있는 AJAX 도구',
	'categorytree-header'           => '트리 구조로 볼 분류 이름을 입력해주세요.
이 기능을 사용하려면 웹 브라우저에서 AJAX를 지원해야 합니다.
오래 된 브라우저를 사용하거나, 브라우저에서 자바스크립트를 사용하지 않도록 설정했다면 트리 기능이 동작하지 않습니다.',
	'categorytree-category'         => '분류:',
	'categorytree-go'               => '트리 보기',
	'categorytree-parents'          => '상위 분류',
	'categorytree-mode-categories'  => '분류 문서만 표시',
	'categorytree-mode-pages'       => '그림을 제외한 모든 문서를 표시',
	'categorytree-mode-all'         => '모든 문서를 표시',
	'categorytree-collapse'         => '접기',
	'categorytree-expand'           => '펼치기',
	'categorytree-load'             => '불러오기',
	'categorytree-loading'          => '불러오는 중',
	'categorytree-nothing-found'    => '결과 없음',
	'categorytree-no-subcategories' => '하위 분류 없음',
	'categorytree-no-pages'         => '문서/하위 분류 없음',
	'categorytree-not-found'        => '‘$1’ 분류가 존재하지 않음',
	'categorytree-error'            => '값을 불러오는 중 오류 발생',
	'categorytree-retry'            => '잠시 후에 다시 시도해주세요.',
	'categorytree-show-list'        => '목록으로 보기',
	'categorytree-show-tree'        => '트리로 보기',
	'categorytree-too-many-subcats' => '하위 분류가 너무 많아 트리를 만들 수 없습니다.',
);

/** Kinaray-a (Kinaray-a)
 * @author Jose77
 */
$messages['krj'] = array(
	'categorytree-category' => 'Kategorya:',
);

/** Ripoarisch (Ripoarisch)
 * @author Purodha
 */
$messages['ksh'] = array(
	'categorytree-header' => "'''Opjepaßß:'''&nbsp;<small>Dat hee brurr_en JavaSkripp_Aadëijl, dä AJAX häijß. Wänn_De enne besöndoß aale Brauser häß, oddo wänn_De JavaSkripp affjeschalldt häß, dann dëijd_et nit.</small> Jivv_enne Saachjroppe_Name enn, dann krėßß_De fun dä Saachjropp dä iere Ennhalld_alls_enne Boum aanjezëijsch.",
);

/** Kurdish (Kurdî / كوردی) */
$messages['ku-latn'] = array(
	'categorytree-tab'              => 'Dar',
	'categorytree-category'         => 'Kategorî',
	'categorytree-load'             => 'bar bike',
	'categorytree-loading'          => 'tê barkirin',
	'categorytree-no-subcategories' => 'binekategorî tune',
);

/** Latin (Latina)
 * @author UV
 */
$messages['la'] = array(
	'categorytree'                  => 'Categoriarum arbor',
	'categorytree-tab'              => 'Arbor',
	'categorytree-header'           => 'Titulum categoriae inscribe ad categoriam hanc quasi arborem videndum. JavaScript et AJAX necesse sunt. Si navigatrum veterrimum habes vel si JavaScript potestatem non fecisti, hac pagina non uti poteris.',
	'categorytree-category'         => 'Categoria',
	'categorytree-go'               => 'Arborem monstrare',
	'categorytree-parents'          => 'Parentes',
	'categorytree-mode-categories'  => 'modo categoriae',
	'categorytree-mode-pages'       => 'paginae nisi imagines',
	'categorytree-mode-all'         => 'omnes paginae',
	'categorytree-collapse'         => 'collabi',
	'categorytree-expand'           => 'dilatare',
	'categorytree-load'             => 'depromere',
	'categorytree-loading'          => 'depromens…',
	'categorytree-nothing-found'    => 'nullum inventum',
	'categorytree-no-subcategories' => 'nullae subcategoriae',
	'categorytree-no-pages'         => 'nec paginae nec subcategoriae',
	'categorytree-not-found'        => 'Categoria <i>$1</i> non inventa',
	'categorytree-show-list'        => 'Monstra quasi indicem',
	'categorytree-show-tree'        => 'Monstra quasi arborem',
	'categorytree-too-many-subcats' => 'Subcategoriae quasi arborem monstrari non possunt, nimis sunt.',
);

/** Ladino (Ladino)
 * @author Runningfridgesrule
 */
$messages['lad'] = array(
	'categorytree-category' => 'Kategoría:',
);

/** Luxembourgish (Lëtzebuergesch)
 * @author Robby
 * @author Kaffi
 * @author Siebrand
 */
$messages['lb'] = array(
	'categorytree'                  => 'Struktur vun de Kategorien',
	'categorytree-tab'              => 'Bam',
	'categorytree-legend'           => 'Weis Kategoriestruktur',
	'categorytree-desc'             => "Gadget deen op Ajax opgebaut ass fir d'[[Special:CategoryTree|Kategorie-Struktur]] vun enger Wiki duerzestellen",
	'categorytree-header'           => 'Gitt den Numm vun enger Kategorie an, fir hiren Inhalt als Bam-Struktur ze gesinn.
Bedenkt, datt dës Fonctioun Java Script Funktioune benotzt, déi als AJAX bekannt sinn. 
Wann Dir ee ganz ale Browser hutt, oder wann Dir JavaScript ausgeschalt hutt, da fonktionnéiert dëst bei Iech net.',
	'categorytree-category'         => 'Kategorie:',
	'categorytree-go'               => 'Struktur weisen',
	'categorytree-parents'          => 'Uewerkategorien',
	'categorytree-mode-categories'  => 'nëmme Kategorien',
	'categorytree-mode-pages'       => 'Säiten ausser Biller',
	'categorytree-mode-all'         => 'all Säiten',
	'categorytree-collapse'         => 'Verstopp',
	'categorytree-expand'           => 'Weis',
	'categorytree-load'             => 'lueden',
	'categorytree-loading'          => 'lueden …',
	'categorytree-nothing-found'    => 'Näischt fonnt',
	'categorytree-no-subcategories' => 'Keng Ënnerkategorien',
	'categorytree-no-pages'         => 'Keng Säiten oder Ënnerkategorien',
	'categorytree-not-found'        => "Kategorie ''$1'' net fonnt",
	'categorytree-error'            => 'Problem beim luede vun den Donneeën.',
	'categorytree-retry'            => 'Waart w.e.g. een Ament a probéiert dann nach eng Kéier.',
	'categorytree-show-list'        => 'Als Lëscht weisen',
	'categorytree-show-tree'        => 'Struktur weisen',
	'categorytree-too-many-subcats' => "D'Struktur vun den Ënnerkategorien kann net duergestalt ginn, well et der zevill sinn.",
);

/** Lezghian (Лезги)
 * @author M.M.S.
 */
$messages['lez'] = array(
	'categorytree-tab' => 'Тар',
);

/** Lingua Franca Nova (Lingua Franca Nova)
 * @author Malafaya
 */
$messages['lfn'] = array(
	'categorytree-tab'      => 'Arbor',
	'categorytree-category' => 'Categoria:',
);

/** Limburgish (Limburgs)
 * @author Ooswesthoesbes
 * @author Siebrand
 */
$messages['li'] = array(
	'categorytree'                  => 'Categorieboum',
	'categorytree-tab'              => 'Boum',
	'categorytree-legend'           => 'Categorieboum laote zeen',
	'categorytree-desc'             => "AJAX-gebaseerde oetbreijing óm de [[Special:CategoryTree|categoriestructuur]] van 'ne wiki te toeane",
	'categorytree-header'           => "Gaef 'ne categorienaam in om de inhoud es 'ne boumstructuur te bekieke.
Let op: deze functie gebroek JavaScript-functionaliteit dae bekindj steit es AJAX.
Esse 'ne erg verajerdje browser höbs of JavaScript steit oet, den werk dees functie neet.",
	'categorytree-category'         => 'Categorie:',
	'categorytree-go'               => 'Laje',
	'categorytree-parents'          => 'Baoveligkendje categorië',
	'categorytree-mode-categories'  => 'allein categorië',
	'categorytree-mode-pages'       => 'gein aafbeildinge',
	'categorytree-mode-all'         => "alle pazjena's",
	'categorytree-collapse'         => 'instorte',
	'categorytree-expand'           => 'oetklappe',
	'categorytree-load'             => 'laje',
	'categorytree-loading'          => "aan 't laje",
	'categorytree-nothing-found'    => 'Dees categorie haet gein subcategorië.',
	'categorytree-no-subcategories' => 'Gein subcategorië.',
	'categorytree-no-pages'         => "Gein pazjena's of óngercategorië.",
	'categorytree-not-found'        => "Categorie ''$1'' neet gevónje",
	'categorytree-error'            => "Perbleem bie 't laje van de gegaeves.",
	'categorytree-retry'            => "Wach estebleef ef en perbeer 't den opnuuj.",
	'categorytree-show-list'        => 'Toean es lies.',
	'categorytree-show-tree'        => 'Toean es boumstructuur.',
	'categorytree-too-many-subcats' => "Kin de óngercategorië neet es boumstructuur toeane, d'r zeen d'rs te väöl.",
);

/** Lao (ລາວ)
 * @author Passawuth
 */
$messages['lo'] = array(
	'categorytree'                  => 'ໂຄງສ້າງໝວດ',
	'categorytree-tab'              => 'ໂຄງສ້າງ',
	'categorytree-legend'           => 'ສະແດງແຜນຜັງໝວດ',
	'categorytree-header'           => 'ພິມຊື່ໝວດໃສ່ ເພື່ອເບິ່ງໂຄງສ້າງມັນ. ຟັງຊັງຕ້ອງການໃຊ້ AJAX ໃນ JavaScript. ຖ້າ ທ່ານ ໃຊ້ໂປຣແກຣມທ່ອງເວັບເກົ່າ ຫຼື ບໍ່ອະນຸຍາດ JavaScript, ມັນກໍ່ຈະບໍ່ເຮັດວຽກ.',
	'categorytree-category'         => 'ໝວດ',
	'categorytree-go'               => 'ສະແດງໂຄງສ້າງ',
	'categorytree-parents'          => 'ໝວດແມ່',
	'categorytree-mode-categories'  => 'ໝວດເທົ່ານັ້ນ',
	'categorytree-mode-pages'       => 'ໜ້າ ນອກຈາກ ໜ້າຮູບ',
	'categorytree-mode-all'         => 'ທຸກໆໜ້າ',
	'categorytree-collapse'         => 'ຫຍໍ້ເຂົ້າ',
	'categorytree-expand'           => 'ຂະຫຍາຍອອກ',
	'categorytree-load'             => 'ໂຫຼດ',
	'categorytree-loading'          => 'ພວມໂຫຼດ',
	'categorytree-nothing-found'    => 'ບໍ່ພົບຫຍັງ',
	'categorytree-no-subcategories' => 'ບໍ່ມີໝວດຍ່ອຍ',
	'categorytree-no-pages'         => 'ບໍ່ມີໜ້າ ຫຼື ໝວດຍ່ອຍ',
	'categorytree-not-found'        => 'ບໍ່ເຫັນ',
	'categorytree-error'            => 'ການໂຫຼດຂໍ້ມູນມີປັນຫາ',
	'categorytree-retry'            => 'ກະລຸນາຮອສັກຄູ່ ແລ້ວລອງໂຫຼດໃໝ່',
	'categorytree-show-list'        => 'ສະແດງເປັນລາຍການ',
	'categorytree-show-tree'        => 'ສະແດງເປັນໂຄງສ້າງ',
	'categorytree-too-many-subcats' => 'ບໍ່ສາມາດສະແດງໝວດເປັນໂຄງສ້າງ ເພາະມັນມີຫຼາຍໝວດໂພດ',
);

/** Lithuanian (Lietuvių)
 * @author Hugo.arg
 */
$messages['lt'] = array(
	'categorytree'                  => 'Kategorijų medis',
	'categorytree-tab'              => 'Medis',
	'categorytree-legend'           => 'Rodyti kategorijų medį',
	'categorytree-header'           => 'Įveskite kategorijos pavadinimą, kad pamatytumėte jos turinį kaip medžio struktūrą.
Primename, kad tam reikia išplėstinis JavaScript fukcionalumas, kitaip žinomas kaip AJAX.
Jei turi labai seną naršyklę, arba esate išjungę JavaScript, tai neveiks.',
	'categorytree-category'         => 'Kategorija',
	'categorytree-go'               => 'Rodyti medį',
	'categorytree-parents'          => 'Aukštesnio lygio kategorija',
	'categorytree-mode-categories'  => 'tik kategorijos',
	'categorytree-mode-pages'       => 'puslapiai išskyrus paveikslėlius',
	'categorytree-mode-all'         => 'visi puslapiai',
	'categorytree-collapse'         => 'suskleisti',
	'categorytree-expand'           => 'išskleisti',
	'categorytree-load'             => 'įkelti',
	'categorytree-loading'          => 'įkeliama',
	'categorytree-nothing-found'    => 'nieko nerasta',
	'categorytree-no-subcategories' => 'nėra jokių subkategorijų',
	'categorytree-no-pages'         => 'jokių puslapių ar subkategorijų',
	'categorytree-not-found'        => 'Kategorija <i>$1</i> nerasta',
	'categorytree-error'            => 'Duomenų įkėlimo problema.',
	'categorytree-retry'            => 'Palaukite šiek tiek, ir bandykite iš naujo.',
	'categorytree-show-list'        => 'Rodyti kaip sąraašą',
	'categorytree-show-tree'        => 'Rodyti kaip medį',
	'categorytree-too-many-subcats' => 'Negalima rodyti subkategorijų kaip medį, nes jų yra per daug.',
);

/** Latvian (Latviešu)
 * @author Yyy
 */
$messages['lv'] = array(
	'categorytree'                  => 'KategorijuKoks',
	'categorytree-tab'              => 'Koks',
	'categorytree-legend'           => 'Rādīt kategoriju koku',
	'categorytree-header'           => 'Ievadi kategorijas nosaukumu lai apskatītos tās saturu kā koka struktūru. 
Tam ir nepieciešama JavaScript (AJAX) funkcionalitāte. 
Ja tev ir veca interneta pārlūkprogramma, vai arī JavaScript ir atslēgts, šitas te nedarbosies.',
	'categorytree-category'         => 'Kategorija:',
	'categorytree-go'               => 'Parādīt koku',
	'categorytree-mode-categories'  => 'tikai kategorijas',
	'categorytree-mode-pages'       => 'lapas (bez attēlu lapām)',
	'categorytree-mode-all'         => 'visas lapas',
	'categorytree-collapse'         => 'sakļaut',
	'categorytree-expand'           => 'izplest',
	'categorytree-loading'          => 'ielādējas...',
	'categorytree-nothing-found'    => 'neko neatrada',
	'categorytree-no-subcategories' => 'nav apakškategoriju',
	'categorytree-no-pages'         => 'nav ne lapu, ne apakškategoriju',
	'categorytree-not-found'        => 'Kategorija <i>$1</i> netika atrasta',
	'categorytree-show-list'        => 'Rādīt kā sarakstu',
	'categorytree-show-tree'        => 'Rādīt kā koku',
	'categorytree-too-many-subcats' => 'Nevar parādīt apakškategorijas kā koku, jo to ir pārāk daudz',
);

/** Malayalam (മലയാളം)
 * @author Shijualex
 */
$messages['ml'] = array(
	'categorytree'                  => 'വര്‍ഗ്ഗവൃക്ഷം',
	'categorytree-tab'              => 'വൃക്ഷം',
	'categorytree-legend'           => 'വര്‍ഗ്ഗവൃക്ഷം പ്രദര്‍ശിപ്പിക്കുക',
	'categorytree-desc'             => 'വിക്കിയിലെ [[Special:CategoryTree|വിഭാഗങ്ങളുടെ ഘടന]] പ്രദര്‍ശിപ്പിക്കുവാനുള്ള  AJAX സാങ്കേതികവിദ്യ ഉപയോഗിക്കുന്ന ഗാഡ്ജറ്റ്.',
	'categorytree-header'           => 'വിഭാഗങ്ങളുടെ ഘടന വ്യക്ഷരൂപത്തില്‍ കാണുവാന്‍ ഒരു വിഭാഗത്തിന്റെ പേരു ചേര്‍ക്കുക.
ഇതു പ്രവര്‍ത്തിക്കണമെങ്കില്‍ AJAX എന്ന ചുരുക്കനാമത്തിലറിയപ്പെടുന്ന അഡ്‌വാന്‍സ്‌ഡ് ജാവാസ്ക്രിപ്റ്റ് സാങ്കേതികവിദ്യ ആവശ്യമാണ്‌.
താങ്കളുടെ ബ്രൗസറില്‍ ജാവാസ്ക്രിപ്റ്റ് പ്രവര്‍ത്തനരഹിതമാക്കിയതാണെങ്കിലോ അല്ലെങ്കില്‍ ബ്രൗസര്‍ കാലഹരണപ്പെട്ടതാണെങ്കിലോ ഇതു പ്രവര്‍ത്തിക്കില്ല.',
	'categorytree-category'         => 'വിഭാഗം:',
	'categorytree-go'               => 'വൃക്ഷം പ്രദര്‍ശിപ്പിക്കുക',
	'categorytree-mode-categories'  => 'വിഭാഗങ്ങള്‍ മാത്രം',
	'categorytree-mode-pages'       => 'ചിത്രങ്ങള്‍ ഒഴിച്ചുള്ള താളുകള്‍',
	'categorytree-mode-all'         => 'എല്ലാ താളുകളും',
	'categorytree-collapse'         => 'അടയ്ക്കുക',
	'categorytree-expand'           => 'വികസിപ്പിക്കുക',
	'categorytree-load'             => 'ലോഡ് ചെയ്യുക',
	'categorytree-loading'          => 'ശേഖരിച്ചുകൊണ്ടിരിക്കുന്നു…',
	'categorytree-nothing-found'    => 'ഒന്നും കണ്ടെത്തിയില്ല',
	'categorytree-no-subcategories' => 'ഉപവിഭാഗങ്ങളില്ല',
	'categorytree-no-pages'         => 'താളുകളോ ഉപവിഭാഗങ്ങളോ ഇല്ല',
	'categorytree-not-found'        => "''$1'' എന്ന വിഭാഗം കണ്ടില്ല",
	'categorytree-error'            => 'ഡാറ്റ ലോഡ് ചെയ്യുന്നതില്‍ പിശക്.',
	'categorytree-retry'            => 'കുറച്ചു നേരം കഴിഞ്ഞ് വീണ്ടും പരിശ്രമിക്കുക',
	'categorytree-show-list'        => 'പട്ടികയായി പ്രദര്‍ശിപ്പിക്കുക',
	'categorytree-show-tree'        => 'വൃക്ഷമായി പ്രദര്‍ശിപ്പിക്കുക',
	'categorytree-too-many-subcats' => 'വളരെയധികം ഉപവര്‍ഗ്ഗങ്ങളുള്ളതിനാല്‍ അതിനെ വൃക്ഷമായി പ്രദര്‍ശിപ്പിക്കാനാവില്ല.',
);

/** Marathi (मराठी)
 * @author Mahitgar
 * @author Siebrand
 * @author Kaustubh
 */
$messages['mr'] = array(
	'categorytree'                  => 'वर्गवृक्ष',
	'categorytree-tab'              => 'वृक्ष',
	'categorytree-legend'           => 'वर्गवृक्ष दाखवा',
	'categorytree-desc'             => 'एखाद्या विकिची [[Special:CategoryTree|वर्गीकरण मांडणी]] दाखवण्याकरिता AJAX वापरून बनवलेले उपकरण',
	'categorytree-header'           => 'एखाद्या वर्गीकरणातील मसुदा वृक्ष स्वरूपात पहाण्याकरिता  त्या वर्गाचे नाव भरा.
या सुविधेकरिता AJAX नावाची आधुनिक जावास्क्रीप्ट सुविधेची गरज भासते हे लक्षात घ्या.हि सुविधा,जर तुमचा विचरक खूप जुना असेल, अथवा त्यातील जावास्क्रीप्ट सुविधा अनुपलब्ध ठेवली असेल तर, काम करणार नाही.',
	'categorytree-category'         => 'वर्ग:',
	'categorytree-go'               => 'वृक्ष दाखवा',
	'categorytree-parents'          => 'पालक',
	'categorytree-mode-categories'  => 'केवळ वर्ग',
	'categorytree-mode-pages'       => 'चित्रे नसलेली पाने',
	'categorytree-mode-all'         => 'सर्व पाने',
	'categorytree-collapse'         => 'कोलॅप्स',
	'categorytree-expand'           => 'विस्तार',
	'categorytree-load'             => 'चढवा',
	'categorytree-loading'          => 'चढवत आहे',
	'categorytree-nothing-found'    => 'काहीच गवसले नाही',
	'categorytree-no-subcategories' => 'उपवर्ग नाहीत',
	'categorytree-no-pages'         => 'पाने अथवा उपवर्ग नाहीत',
	'categorytree-not-found'        => 'वर्ग <i>$1</i> आढळला नाही',
	'categorytree-error'            => 'विदा चढवताना त्रूटी.',
	'categorytree-retry'            => 'कृपया,क्षणभर थांबा आणि पुन्हा प्रयत्न करा.',
	'categorytree-show-list'        => 'सूची स्वरूपात दाखवा',
	'categorytree-show-tree'        => 'वृक्ष स्वरूपात दाखवा',
	'categorytree-too-many-subcats' => 'उपवर्ग वृक्ष स्वरूपात दाखवता येणार नाहीत, कारण ते खूप अधीक आहेत.',
);

/** Malay (Bahasa Melayu)
 * @author Aviator
 */
$messages['ms'] = array(
	'categorytree'                  => 'SalasilahKategori',
	'categorytree-tab'              => 'Salasilah',
	'categorytree-header'           => 'Masukkan suatu nama kategori untuk melihat kandungannya dalam bentuk struktur salasilah.
Ciri ini memerlukan kebolehan JavaScript maju yang dikenali sebagai AJAX.
Sekiranya anda menggunakan pelayar web yang lama, atau mematikan JavaScript, ciri ini tidak akan menjadi.',
	'categorytree-category'         => 'Kategori',
	'categorytree-go'               => 'Tunjukkan Salasilah',
	'categorytree-parents'          => 'Induk',
	'categorytree-mode-categories'  => 'kategori sahaja',
	'categorytree-mode-pages'       => 'laman kecuali imej',
	'categorytree-mode-all'         => 'semua laman',
	'categorytree-collapse'         => 'tutup',
	'categorytree-expand'           => 'buka',
	'categorytree-load'             => 'muat',
	'categorytree-loading'          => 'memuat',
	'categorytree-nothing-found'    => 'kosong',
	'categorytree-no-subcategories' => 'tiada subkategori',
	'categorytree-no-pages'         => 'tiada laman atau subkategori',
	'categorytree-not-found'        => 'Kategori <i>$1</i> tiada',
	'categorytree-error'            => 'Berlaku masalah ketika memuat data.',
	'categorytree-retry'            => 'Sila tunggu sebentar dan cuba lagi.',
	'categorytree-show-list'        => 'Tunjuk dalam bentuk senarai',
	'categorytree-show-tree'        => 'Tunjuk dalam bentuk salasilah',
	'categorytree-too-many-subcats' => 'Terlalu banyak subkategori, tidak boleh menunjukkannya dalam bentuk salasilah.',
);

/** Erzya (эрзянь кель)
 * @author Amdf
 * @author Siebrand
 */
$messages['myv'] = array(
	'categorytree-category' => 'Категория:',
	'categorytree-mode-all' => 'весе лопатне',
);

/** Bân-lâm-gú (Bân-lâm-gú) */
$messages['nan'] = array(
	'categorytree-loading'          => 'teh ji̍p',
	'categorytree-no-subcategories' => 'bô ē-lūi-pia̍t',
);

/** Low German (Plattdüütsch)
 * @author Slomox
 * @author Siebrand
 */
$messages['nds'] = array(
	'categorytree'                  => 'Kategorie-Boom',
	'categorytree-tab'              => 'Boom',
	'categorytree-legend'           => 'Kategorieboom wiesen',
	'categorytree-header'           => 'Kategorienaam ingeven, den Inholt as Boomstruktur to sehn. Schasst di bewusst wesen, dat Javascript un de AJAX-Funkschoon dor för bruukt warrt. Wenn dien Nettkieker to oolt is oder du keen Javascript hest, denn warrt dat nix.',
	'categorytree-category'         => 'Kategorie:',
	'categorytree-go'               => 'Boom wiesen',
	'categorytree-parents'          => 'Öllernkategorien',
	'categorytree-mode-categories'  => 'blot Kategorien',
	'categorytree-mode-pages'       => 'Sieden ahn Biller',
	'categorytree-mode-all'         => 'all Sieden',
	'categorytree-collapse'         => 'nich ganz wiesen',
	'categorytree-expand'           => 'ganz wiesen',
	'categorytree-load'             => 'laden',
	'categorytree-loading'          => 'läädt',
	'categorytree-nothing-found'    => 'nix funnen',
	'categorytree-no-subcategories' => 'kene Ünnerkategorien',
	'categorytree-no-pages'         => 'kene Sieden oder Ünnerkategorien',
	'categorytree-not-found'        => 'Kategorie <i>$1</i> nich funnen',
	'categorytree-error'            => 'Problem bi’t Laden vun de Daten',
	'categorytree-retry'            => 'Tööv en beten un denn versöök dat noch wedder.',
	'categorytree-show-list'        => 'as List wiesen',
	'categorytree-show-tree'        => 'as Boom wiesen',
	'categorytree-too-many-subcats' => 'Kann Ünnerkategorien nich as Boom wiesen, sünd to veel.',
);

/** Nepali (नेपाली)
 * @author SPQRobin
 * @author Siebrand
 */
$messages['ne'] = array(
	'categorytree-category'         => 'श्रेणी:',
	'categorytree-mode-categories'  => 'श्रेणी मात्र',
	'categorytree-mode-pages'       => 'तस्वीरहरू बाहेकका पृष्ठहरू',
	'categorytree-mode-all'         => 'सबै पृष्ठहरु',
	'categorytree-collapse'         => 'खुम्च्याउनु',
	'categorytree-expand'           => 'फैलाउनु',
	'categorytree-nothing-found'    => 'केहीपनि फेला परेन',
	'categorytree-no-subcategories' => 'उपश्रेणीहरू छैनन्',
	'categorytree-no-pages'         => 'पृष्ठहरू वा उपश्रेणीहरू छैनन्',
	'categorytree-not-found'        => 'श्रेणी <i>$1</i> फेला परेन',
);

/** Dutch (Nederlands)
 * @author Siebrand
 */
$messages['nl'] = array(
	'categorytree'                  => 'Categorieboom',
	'categorytree-tab'              => 'Boom',
	'categorytree-legend'           => 'Categorieboom weergeven',
	'categorytree-desc'             => 'AJAX-gebaseerde uitbreiding om de [[Special:CategoryTree|categoriestructuur]] van een wiki te bekijken',
	'categorytree-header'           => 'Geef een categorienaam in om de inhoud als een boomstructuur te bekijken.
Let op: deze functie gebruikt JavaScript-functionaliteit die bekend staat als AJAX.
Als u een verouderde browser hebt of JavaScript uitgeschakeld is, dan werkt deze functie niet.',
	'categorytree-category'         => 'Categorie',
	'categorytree-go'               => 'Laden',
	'categorytree-parents'          => 'Bovenliggende categorieën',
	'categorytree-mode-categories'  => 'alleen categorieën',
	'categorytree-mode-pages'       => 'geen afbeeldingen',
	'categorytree-mode-all'         => "alle pagina's",
	'categorytree-collapse'         => 'inklappen',
	'categorytree-expand'           => 'uitklappen',
	'categorytree-load'             => 'laden',
	'categorytree-loading'          => 'aan het laden',
	'categorytree-nothing-found'    => 'niets gevonden',
	'categorytree-no-subcategories' => 'Geen ondercategorieën.',
	'categorytree-no-pages'         => "Geen pagina's of ondercategorieën.",
	'categorytree-not-found'        => "Categorie ''$1'' niet gevonden",
	'categorytree-error'            => 'Probleem bij het laden van de gegevens.',
	'categorytree-retry'            => 'Wacht alstublieft even en probeer het dan opnieuw.',
	'categorytree-show-list'        => 'Als lijst weergeven',
	'categorytree-show-tree'        => 'Als boomstructuur weergeven',
	'categorytree-too-many-subcats' => 'Kan de ondercategorieën niet als boomstructuur weergeven. Het zijn er te veel.',
);

/** Norwegian Nynorsk (‪Norsk (nynorsk)‬)
 * @author Eirik
 * @author Siebrand
 */
$messages['nn'] = array(
	'categorytree'                  => 'Kategoritre',
	'categorytree-tab'              => 'Tre',
	'categorytree-header'           => 'Skriv inn eit kategorinamn for å sjå innhaldet som ein trestruktur. Merk at denne funksjonen nyttar avansert [[JavaScript]]-funksjonalitet ([[AJAX]]). Dersom du brukar ein veldig gammal nettlesar, eller har slått av JavaScript-støtte, vil dette ikkje fungere.',
	'categorytree-category'         => 'Kategori:',
	'categorytree-go'               => 'Vis kategoritre',
	'categorytree-parents'          => 'Overkategoriar',
	'categorytree-mode-categories'  => 'berre kategoriane',
	'categorytree-mode-pages'       => 'sider, men ikkje filer',
	'categorytree-mode-all'         => 'alle sidene',
	'categorytree-collapse'         => 'gøym',
	'categorytree-expand'           => 'vis',
	'categorytree-load'             => 'last inn',
	'categorytree-loading'          => 'lastar inn',
	'categorytree-nothing-found'    => 'fann ikkje noko',
	'categorytree-no-subcategories' => 'ingen underkategoriar',
	'categorytree-no-pages'         => 'ingen sider eller underkategoriar',
	'categorytree-not-found'        => 'Fann ikkje kategorien <i>$1</i>',
	'categorytree-error'            => 'Problem med innlasting av data.',
	'categorytree-retry'            => 'Ver venleg og vent litt før du prøvar ein gong til.',
	'categorytree-show-list'        => 'Vis som liste',
	'categorytree-show-tree'        => 'Vis som tre',
	'categorytree-too-many-subcats' => 'Kan ikkje vise underkategoriar som tre, det er for mange av dei.',
);

/** Norwegian (bokmål)‬ (‪Norsk (bokmål)‬)
 * @author Jon Harald Søby
 */
$messages['no'] = array(
	'categorytree'                  => 'Kategoritre',
	'categorytree-tab'              => 'Tre',
	'categorytree-legend'           => 'Vis kategoritre',
	'categorytree-desc'             => 'AJAX-basert verktøy som viser [[Special:CategoryTree|kategoristrukturen]] til en wiki',
	'categorytree-header'           => 'Skriv inn et kategorinavn for å se dens innhold som en trestruktur. Merk at dette trenger en avansert type Javascript-funksjonalitet kjent som AJAX. Dersom du har en gammel nettleser eller har slått av Javascript vil dette ikke fungere.

Enter a category name to see its contents as a tree structure. Note that this requires advanced JavaScript functionality known as AJAX. If you have a very old browser, or have JavaScript disabled, it will not work.',
	'categorytree-category'         => 'Kategori:',
	'categorytree-go'               => 'Vis',
	'categorytree-parents'          => 'Overkategorier',
	'categorytree-mode-categories'  => 'bare kategorier',
	'categorytree-mode-pages'       => 'sider utenom bilder',
	'categorytree-mode-all'         => 'alle sider',
	'categorytree-collapse'         => 'skjul',
	'categorytree-expand'           => 'vis',
	'categorytree-load'             => 'last',
	'categorytree-loading'          => 'laster',
	'categorytree-nothing-found'    => 'Ingen resultater funnet.',
	'categorytree-no-subcategories' => 'Ingen underkategorier.',
	'categorytree-no-pages'         => 'Ingen artikler eller underkategorier.',
	'categorytree-not-found'        => 'Kategorien <i>$1</i> ikke funnet',
	'categorytree-error'            => 'problem under datalasting.',
	'categorytree-retry'            => 'Vent en stund og prøv igjen.',
	'categorytree-show-list'        => 'Vis som liste',
	'categorytree-show-tree'        => 'Vis som tre',
	'categorytree-too-many-subcats' => 'Kan ikke vise underkategorier som tre, det er for mange av dem.',
);

/** Northern Sotho (Sesotho sa Leboa)
 * @author Mohau
 * @author Siebrand
 */
$messages['nso'] = array(
	'categorytree-tab'       => 'Sehlare',
	'categorytree-category'  => 'Sehlopha:',
	'categorytree-go'        => 'Bontsha Sehlare',
	'categorytree-parents'   => 'Batswadi',
	'categorytree-mode-all'  => 'matlakala kamoka',
	'categorytree-collapse'  => 'tswalela',
	'categorytree-expand'    => 'bula',
	'categorytree-no-pages'  => 'gago matlakala goba dihlophana',
	'categorytree-not-found' => 'Sehlopha <i>$1</i> ga se humanege',
	'categorytree-show-list' => 'Laetša bjalo ka lenano',
	'categorytree-show-tree' => 'Laetša bjalo ka sehlare',
);

/** Occitan (Occitan)
 * @author Cedric31
 */
$messages['oc'] = array(
	'categorytree'                  => 'Arborescéncia de las categorias',
	'categorytree-tab'              => 'Arborescéncia',
	'categorytree-legend'           => 'Visionar l’arborescéncia de la categoria',
	'categorytree-desc'             => "Gadget basat sus AJAX per afichar l'[[Special:CategoryTree|estructura de la categoria]] d’un wiki",
	'categorytree-header'           => "Picatz un nom de categoria per veire son contengut en estructura arborescenta. Notatz qu'aquò utiliza de foncionalitats JavaScript avançadas conegudas jol nom d'AJAX. S'avètz un navigaire fòrt vièlh o qu'avètz pas activat lo JavaScript, aquò foncionarà pas.",
	'categorytree-category'         => 'Categoria :',
	'categorytree-go'               => "Mostrar l'arborescéncia",
	'categorytree-parents'          => 'Subrecategoria(s)',
	'categorytree-mode-categories'  => 'pas que las categorias',
	'categorytree-mode-pages'       => 'paginas sens los imatges',
	'categorytree-mode-all'         => 'totas las paginas',
	'categorytree-collapse'         => 'Rebatre',
	'categorytree-expand'           => 'Desplegar',
	'categorytree-load'             => 'Dobrir',
	'categorytree-loading'          => 'dobertura...',
	'categorytree-nothing-found'    => 'Cap de soscategoria',
	'categorytree-no-subcategories' => 'Pas de soscategoria',
	'categorytree-no-pages'         => 'Pas de pagina o de soscategoria',
	'categorytree-not-found'        => 'La categoria <i>$1</i> es pas estada trobada.',
	'categorytree-error'            => 'Problèma de cargament de las donadas.',
	'categorytree-retry'            => 'Esperatz un moment puèi tornatz ensajar.',
	'categorytree-show-list'        => 'Afichar en lista',
	'categorytree-show-tree'        => 'Afichar en arborescéncia',
	'categorytree-too-many-subcats' => "Impossible d'afichar las soscategorias jos forma d'arbre, n'i a tròp.",
);

/** Ossetic (Иронау)
 * @author Amikeco
 */
$messages['os'] = array(
	'categorytree-tab'              => 'Бæлас',
	'categorytree-category'         => 'Категори:',
	'categorytree-go'               => 'Равдис бæлас',
	'categorytree-mode-all'         => 'æппæт фæрстæ',
	'categorytree-nothing-found'    => 'Ацы категорийы мидæг дæлкатегоритæ нæ разынд',
	'categorytree-no-pages'         => 'фæрстæ æмæ дæлкатегоритæ нæй',
	'categorytree-not-found'        => 'Категори «$1» не ссардæуы.',
	'categorytree-show-list'        => 'Номхыгъды хуызы равдис',
	'categorytree-show-tree'        => 'Бæласы хуызы равдис',
	'categorytree-too-many-subcats' => 'Дæлкатегоритæ бæласы хуызы равдисæн нæй — æгæр бирæ сты.',
);

/** Pangasinan (Pangasinan)
 * @author SPQRobin
 */
$messages['pag'] = array(
	'categorytree-mode-pages'    => 'Saray bolobolong ya aga kaibay picture',
	'categorytree-mode-all'      => 'Amin ya bolobolong',
	'categorytree-collapse'      => 'isara',
	'categorytree-expand'        => 'lukasan',
	'categorytree-load'          => 'I-lugan',
	'categorytree-nothing-found' => 'anggapoy naanap',
	'categorytree-no-pages'      => 'Anggapoy bolong odino subcategory',
	'categorytree-show-list'     => 'Ipanengneng so listaan',
);

/** Pampanga (Kapampangan)
 * @author SPQRobin
 */
$messages['pam'] = array(
	'categorytree-mode-pages'    => 'bulung liban kareng larawan',
	'categorytree-mode-all'      => 'Eganaganang bulung',
	'categorytree-collapse'      => 'ilati',
	'categorytree-expand'        => 'paragulan',
	'categorytree-load'          => 'lulan',
	'categorytree-loading'       => 'Lululan',
	'categorytree-nothing-found' => 'alang meyakit',
	'categorytree-show-list'     => 'Pakit ya antimong listaan o talaan',
);

/** Polish (Polski)
 * @author Sp5uhe
 * @author Derbeth
 * @author Matma Rex
 */
$messages['pl'] = array(
	'categorytree'                  => 'Drzewo kategorii',
	'categorytree-tab'              => 'Drzewo',
	'categorytree-legend'           => 'Pokaż drzewo kategorii',
	'categorytree-desc'             => 'Gadżet oparty na technologii AJAX, wyświetlający [[Special:CategoryTree|drzewo kategorii]]',
	'categorytree-header'           => 'Wpisz nazwę kategorii, by zobaczyć jej zawartość w postaci drzewa. Wymagana jest zaawansowana funkcjonalność JavaScriptu, znana jako AJAX. Jeśli masz bardzo starą przeglądarkę lub wyłączony JavaScript, ta funkcja nie zadziała.',
	'categorytree-category'         => 'Kategoria',
	'categorytree-go'               => 'Ładuj kategorię',
	'categorytree-parents'          => 'Kategorie główne',
	'categorytree-mode-categories'  => 'tylko kategorie',
	'categorytree-mode-pages'       => 'strony oprócz grafik',
	'categorytree-mode-all'         => 'wszystkie strony',
	'categorytree-collapse'         => 'zwiń',
	'categorytree-expand'           => 'rozwiń',
	'categorytree-load'             => 'wczytaj',
	'categorytree-loading'          => 'wczytywanie...',
	'categorytree-nothing-found'    => 'nic nie znaleziono',
	'categorytree-no-subcategories' => 'brak podkategorii',
	'categorytree-no-pages'         => 'brak artykułów lub podkategorii.',
	'categorytree-not-found'        => 'Kategoria <i>$1</i> nie została znaleziona',
	'categorytree-error'            => 'Problem z ładowaniem danych.',
	'categorytree-retry'            => 'Poczekaj chwilę i spróbuj ponownie – kliknij ten napis.',
	'categorytree-show-list'        => 'Prezentuj jako listę',
	'categorytree-show-tree'        => 'Prezentuj w formie drzewa',
	'categorytree-too-many-subcats' => 'Podkategorie nie mogą być wyświetlone jako drzewo, ponieważ jest ich zbyt wiele.',
);

/** Piemontèis (Piemontèis)
 * @author Bèrto 'd Sèra
 * @author Siebrand
 */
$messages['pms'] = array(
	'categorytree'                  => 'Erbo dle categorìe',
	'categorytree-tab'              => 'Erbo',
	'categorytree-header'           => "Ch'a buta ël nòm ëd na categorìa për ës-ciairene ij contnù e la strutura. Ch'a ten-a present che përchè sòn a travaja a-i va na fonsion Javascript avansà ch'as ciama AJAX. Se un a l'ha un navigator vej ò pura a l'ha nen abilità Javascript sossì a travaja nen.",
	'categorytree-category'         => 'Categorìa:',
	'categorytree-go'               => "Deurbe l'erbo",
	'categorytree-parents'          => 'Cé',
	'categorytree-mode-categories'  => 'smon mach le categorìe',
	'categorytree-mode-pages'       => 'mach le pàgine gavà le figure',
	'categorytree-mode-all'         => 'tute le pàgine',
	'categorytree-collapse'         => 'sëré',
	'categorytree-expand'           => 'deurbe',
	'categorytree-load'             => 'carié',
	'categorytree-loading'          => "antramentr ch'as carìa",
	'categorytree-nothing-found'    => 'pa trovà gnente',
	'categorytree-no-subcategories' => 'gnun-a sot-categorìa',
	'categorytree-no-pages'         => 'pa ëd pàgine ò ëd sot-categorìe',
	'categorytree-not-found'        => "A l'é pa trovasse la categorìa <i>$1</i>.",
	'categorytree-error'            => 'Problema ën cariand ij dat',
	'categorytree-retry'            => "Për piasì, ch'a speta na minuta e peuj ch'as preuva n'àutra vira.",
	'categorytree-show-list'        => 'smon-e coma lista',
	'categorytree-show-tree'        => 'smon-e coma erbo',
	'categorytree-too-many-subcats' => "As peulo nen ësmon-se le sot-categorìe coma erbo për via ch'a-i n'a-i é tròpe.",
);

/** Pashto (پښتو)
 * @author Ahmed-Najib-Biabani-Ibrahimkhel
 * @author Siebrand
 */
$messages['ps'] = array(
	'categorytree'                  => 'د وېشنيزو ونه',
	'categorytree-tab'              => 'ونه',
	'categorytree-category'         => ':وېشنيزه',
	'categorytree-go'               => 'ونه ښکاره کول',
	'categorytree-mode-categories'  => 'يوازې وېشنيزې',
	'categorytree-mode-pages'       => 'مخونه پرته د انځورونو نه',
	'categorytree-mode-all'         => 'ټول مخونه',
	'categorytree-expand'           => 'غځول',
	'categorytree-nothing-found'    => 'هېڅ هم و نه موندل شو',
	'categorytree-no-subcategories' => 'هېڅ وړې-وېشنيزې نشته',
	'categorytree-no-pages'         => 'هېڅ مخ يا وړه-وېشنيزه نشته',
	'categorytree-not-found'        => 'د <i>$1</i> وېشنيزه و نه موندل شوه',
	'categorytree-retry'            => 'مهرباني وکړی لږ څه تم شی او بيا يې وآزمايۍ',
	'categorytree-show-list'        => 'د لړليک په څېر ښکاره کول',
	'categorytree-show-tree'        => 'د ونې په څېر ښکاره کول',
	'categorytree-too-many-subcats' => 'وړې-وېشنيزې د ونې په څېر نه شو ښکاره کولای، همدلته ډېرې زياتې وړې وېشنيزې دي.',
);

/** Portuguese (Português)
 * @author 555
 * @author Siebrand
 */
$messages['pt'] = array(
	'categorytree'                  => 'Árvore de categorias',
	'categorytree-tab'              => 'Árvore',
	'categorytree-legend'           => 'Exibir a árvore de categorias',
	'categorytree-desc'             => 'Acessório (gadget) baseado em AJAX que apresenta a [[Special:CategoryTree|estrutura]] de um wiki',
	'categorytree-header'           => 'Insira o nome de uma categoria para ver seu conteúdo como uma estrutura de "árvore".
Note que isso requer funcionalidades avançadas de JavaScript (como, por exemplo, AJAX).
Caso o seu navegador seja razoavelmente antigo, ou, caso JavaScript esteja desabilitado em seu navegador, isto não funcionará.',
	'categorytree-category'         => 'Categoria',
	'categorytree-go'               => 'Exibir Árvore',
	'categorytree-parents'          => 'Categorias superiores',
	'categorytree-mode-categories'  => 'mostrar só categorias',
	'categorytree-mode-pages'       => 'páginas com exceção de imagens',
	'categorytree-mode-all'         => 'todas as páginas',
	'categorytree-collapse'         => 'ocultar',
	'categorytree-expand'           => 'expandir',
	'categorytree-load'             => 'carregar',
	'categorytree-loading'          => 'carregando',
	'categorytree-nothing-found'    => 'Sentimos muito, não se encontrou nada',
	'categorytree-no-subcategories' => 'sem subcategorias.',
	'categorytree-no-pages'         => 'sem páginas nem subcategorias',
	'categorytree-not-found'        => "A categoria ''$1'' não foi encontrada",
	'categorytree-error'            => 'Problema ao carregar os dados.',
	'categorytree-retry'            => 'Por gentileza, aguarde um momento e tente novamente.',
	'categorytree-show-list'        => 'Exibir como lista',
	'categorytree-show-tree'        => 'Exibir como árvore',
	'categorytree-too-many-subcats' => 'Não é possível exibir as subcategorias no modo de árvore, existem muitas subcategorias.',
);

/** Quechua (Runa Simi)
 * @author AlimanRuna
 * @author Siebrand
 */
$messages['qu'] = array(
	'categorytree'                  => "Katiguriya sach'a (CategoryTree)",
	'categorytree-tab'              => "Sach'a",
	'categorytree-header'           => "Katiguriya sutita yaykuchiy samiqninta sach'a hinata rikunaykipaq.
Musyariy, kaytaqa AJAX nisqa sapaq JavaScript ruranallawanmi llamk'achiyta atinki. Mawk'a wamp'unawanqa icha JavaScript nisqaman ama nispaqa manam atinkichu.",
	'categorytree-category'         => 'Katiguriya:',
	'categorytree-go'               => "Sach'ata rikuchiy",
	'categorytree-parents'          => 'Mama katiguriyakuna',
	'categorytree-mode-categories'  => 'Katiguriyakunalla',
	'categorytree-mode-pages'       => "p'anqakuna amataq rikchakuna",
	'categorytree-mode-all'         => "tukuy p'anqakuna",
	'categorytree-collapse'         => 'pakay',
	'categorytree-expand'           => 'rikuchiy',
	'categorytree-load'             => 'chaqnay',
	'categorytree-loading'          => 'chaqnaspa',
	'categorytree-nothing-found'    => 'manam imapas tarisqachu',
	'categorytree-no-subcategories' => 'mana ima urin katiguriyapas',
	'categorytree-no-pages'         => 'mana ima urin qillqapas ni katiguriyapas',
	'categorytree-not-found'        => '<i>$1</i> sutiyuq katiguriyaqa manam tarisqachu',
	'categorytree-error'            => 'Manam atinichu willakunata chaqnayta.',
	'categorytree-retry'            => 'Asllata suyaspa musuqmanta ruraykachay.',
	'categorytree-show-list'        => 'Sutisuyuta rikuchiy',
	'categorytree-show-tree'        => "Sach'a hinata rikuchiy",
);

/** Romanian (Română)
 * @author KlaudiuMihaila
 * @author Siebrand
 */
$messages['ro'] = array(
	'categorytree-tab'              => 'Arbore',
	'categorytree-header'           => 'Introduceţi numele categoriei pentru vizualizarea conţinutului în structură arborescentă. Notaţi faptul că această operaţie necesită funcţionalităţi JavaScript avansate cunoscute sub numele de AJAX. Dacă aveţi un browser vechi sau nu aveţi activat JavaScript, nu va funcţiona.',
	'categorytree-category'         => 'Categorie:',
	'categorytree-go'               => 'Arată arborele',
	'categorytree-parents'          => 'Părinţi',
	'categorytree-mode-categories'  => 'doar categorii',
	'categorytree-mode-pages'       => 'pagini, fără imagini',
	'categorytree-mode-all'         => 'toate paginile',
	'categorytree-collapse'         => 'restrânge',
	'categorytree-expand'           => 'extinde',
	'categorytree-load'             => 'încarcă',
	'categorytree-loading'          => 'încărcare',
	'categorytree-no-subcategories' => 'nici o subcategorie',
	'categorytree-no-pages'         => 'nici o pagină sau subcategorie',
	'categorytree-not-found'        => 'Categoria <i>$1</i> nu a fost găsită',
	'categorytree-show-list'        => 'Arată ca listă',
	'categorytree-show-tree'        => 'Arată ca arbore',
);

/** Russian (Русский)
 * @author Александр Сигачёв
 * @author Ahonc
 */
$messages['ru'] = array(
	'categorytree'                  => 'Дерево категорий',
	'categorytree-tab'              => 'Дерево',
	'categorytree-legend'           => 'Показать дерево категорий',
	'categorytree-desc'             => 'AJAX-компонент для отображения [[Special:CategoryTree|структуры категорий]] вики',
	'categorytree-header'           => 'Введите имя категории, и она будет показана в виде дерева.
Эта возможность доступна, только если ваш браузер поддерживает AJAX.
Если у вас старая версия браузера или отключен JavaScript, показ подкатегорий в виде дерева недоступен.',
	'categorytree-category'         => 'Категория:',
	'categorytree-go'               => 'Загрузить',
	'categorytree-parents'          => 'Родительские категории',
	'categorytree-mode-categories'  => 'только категории',
	'categorytree-mode-pages'       => 'кроме изображений',
	'categorytree-mode-all'         => 'все страницы',
	'categorytree-collapse'         => 'свернуть',
	'categorytree-expand'           => 'развернуть',
	'categorytree-load'             => 'загрузить',
	'categorytree-loading'          => 'загрузка…',
	'categorytree-nothing-found'    => 'Данная категория не содержит подкатегорий.',
	'categorytree-no-subcategories' => 'нет подкатегорий.',
	'categorytree-no-pages'         => 'нет статей и подкатегорий.',
	'categorytree-not-found'        => 'Категория «$1» не найдена.',
	'categorytree-error'            => 'Ошибка загрузки данных.',
	'categorytree-retry'            => 'Пожалуйста, подождите и попробуйте ещё раз.',
	'categorytree-show-list'        => 'Список',
	'categorytree-show-tree'        => 'Дерево',
	'categorytree-too-many-subcats' => 'Невозможно показать подкатегории в виде дерева — их слишком много.',
);

/** Yakut (Саха тыла)
 * @author HalanTul
 * @author Siebrand
 */
$messages['sah'] = array(
	'categorytree'                  => 'Категориялар мас курдук',
	'categorytree-tab'              => 'Мас курдук',
	'categorytree-legend'           => 'Категориялар тутулларын көрдөр',
	'categorytree-desc'             => 'Биики [[Special:CategoryTree|категорияларын тутулун]] көрдөрөр AJAX-компонент',
	'categorytree-header'           => 'Категория аатын киллэрдэххинэ мас курдук көстүөҕэ.
Бу кыаҕы браузерыҥ AJAX-ы туһанар эрэ буоллаҕына туттар кыахтааххын.
Браузерыҥ эргэ буоллаҕына эбэтэр JavaScript арахсыбыт буоллаҕына субкатегорийалары мас курдук көрөр сатаммат.',
	'categorytree-category'         => 'Категория:',
	'categorytree-go'               => 'Көрдөр',
	'categorytree-parents'          => 'Төрөппүттэрэ',
	'categorytree-mode-categories'  => 'категориялар эрэ',
	'categorytree-mode-pages'       => 'ойуулартан ураты',
	'categorytree-mode-all'         => 'бары сирэйдэр',
	'categorytree-collapse'         => 'сап',
	'categorytree-expand'           => 'тэнит',
	'categorytree-load'             => 'киллэр',
	'categorytree-loading'          => 'киллэрии',
	'categorytree-nothing-found'    => 'бу категория подкатегорията суох',
	'categorytree-no-subcategories' => 'субкатегорията суох',
	'categorytree-no-pages'         => 'ыстатыйата эбэтэр субкатегорията суох',
	'categorytree-not-found'        => '<i>$1</i> категория көстүбэтэ',
	'categorytree-error'            => 'Билэни суруйарга алҕас таҕыста',
	'categorytree-retry'            => 'Кыратык кэтэһэ түһэн баран өссө боруобалаа',
	'categorytree-show-list'        => 'Тиһик (Испииһэк)',
	'categorytree-show-tree'        => 'Мас курдук',
	'categorytree-too-many-subcats' => 'Субкатегориялары мас курдук көрдөрөр табыллыбата - элбэхтэрэ бэрт.',
);

/** Sassaresu (Sassaresu)
 * @author Felis
 * @author Siebrand
 */
$messages['sdc'] = array(
	'categorytree'                  => "Sthruttura ad'àiburu di li categuri",
	'categorytree-tab'              => 'Àiburu',
	'categorytree-header'           => "Insirì l'innommu di la categuria di la quari si vó vidé lu cuntinuddu attrabessu la sthruttura ad'àiburu. Amminta chi la pàgina vó li funzionariddai abanzaddi di JavaScript ciamaddi AJAX; s'ài un nabiggddori vécciu o cu' li funzioni JavaScript disàbiritaddi, chistha pàgina nò funziunerà.",
	'categorytree-category'         => 'Categuria:',
	'categorytree-go'               => 'Carrigga',
	'categorytree-parents'          => 'Categuri superiori',
	'categorytree-mode-categories'  => 'musthra soru li categuri',
	'categorytree-mode-pages'       => "tutti li pàgini, eschrusi l'immàgini",
	'categorytree-mode-all'         => 'tutti li pàgini',
	'categorytree-collapse'         => 'cumprimi',
	'categorytree-expand'           => 'ippaglia',
	'categorytree-load'             => 'carrigga',
	'categorytree-loading'          => 'carrigghendi...',
	'categorytree-nothing-found'    => 'nisciun risulthaddu',
	'categorytree-no-subcategories' => 'nisciuna sottucateguria.',
	'categorytree-no-pages'         => 'nisciuna bozi ni sottucateguria.',
	'categorytree-not-found'        => "Categuria ''$1'' nò acciappadda",
	'categorytree-error'            => "Probrema i' lu carriggamentu di li dati.",
	'categorytree-retry'            => "Pa piazeri aisetta un'àttimu e poi torra a prubà.",
	'categorytree-show-list'        => 'Listha',
	'categorytree-show-tree'        => "Sthruttura ad'àiburu",
	'categorytree-too-many-subcats' => "Li sottucateguri sò troppi pa assé visuarizzaddi attrabessu la sthruttura ad'àiburu.",
);

/** Slovak (Slovenčina)
 * @author Helix84
 * @author Siebrand
 */
$messages['sk'] = array(
	'categorytree'                  => 'Strom kategórií',
	'categorytree-tab'              => 'Strom',
	'categorytree-legend'           => 'Zobraziť strom kategórií',
	'categorytree-desc'             => 'AJAXový nástroj na zobrazovanie [[Special:CategoryTree|štruktúry kategórií]] wiki',
	'categorytree-header'           => 'Zadajte názov kategórie, ktorej obsah sa má zobraziť ako stromová štruktúra.
Majte na pamäti, že táto funkcia vyžaduje JavaScriptovú funkcionalitu známu ako AJAX.
Ak máte veľmi starý prehliadač alebo máte vypnutý JavaScrpt, nebude fungovať.',
	'categorytree-category'         => 'Kategória',
	'categorytree-go'               => 'Zobraziť strom',
	'categorytree-parents'          => 'Nadradené kategórie',
	'categorytree-mode-categories'  => 'iba kategórie',
	'categorytree-mode-pages'       => 'stránky okrem obrázkov',
	'categorytree-mode-all'         => 'všetky stránky',
	'categorytree-collapse'         => 'zbaliť',
	'categorytree-expand'           => 'rozbaliť',
	'categorytree-load'             => 'načítať',
	'categorytree-loading'          => 'načítava sa',
	'categorytree-nothing-found'    => 'nebolo nič nájdené',
	'categorytree-no-subcategories' => 'žiadne podkategórie.',
	'categorytree-no-pages'         => 'žiadne stránky ani podkategórie.',
	'categorytree-not-found'        => 'Kategória <i>$1</i> nenájdená',
	'categorytree-error'            => 'Problém pri načítavaní údajov.',
	'categorytree-retry'            => 'Prosím, chvíľu počkajte a skúste to znova.',
	'categorytree-show-list'        => 'Zobraziť ako zoznam',
	'categorytree-show-tree'        => 'Zobraziť ako strom',
	'categorytree-too-many-subcats' => 'Nie je možné zobraziť podkategórie ako strom, je ich príliš veľa.',
);

/** Slovenian (Slovenščina)
 * @author editors of sl.wikipedia
 */
$messages['sl'] = array(
	'categorytree'                  => 'Drevo kategorij',
	'categorytree-tab'              => 'Drevo',
	'categorytree-header'           => 'Vnesite ime kategorije, katere vsebino želite videti kot drevesno strukturo. Upoštevajte, da je za to potreben AJAX, poseben nacin za delovanje JavaScripta. Ce je vaš brskalnik zelo star oziroma je JavaScript v njem onemogocen, drevo kategorij ne bo prikazano.',
	'categorytree-category'         => 'Kategorija',
	'categorytree-go'               => 'Pokaži drevo',
	'categorytree-parents'          => 'Starši',
	'categorytree-mode-categories'  => 'samo kategorije',
	'categorytree-mode-pages'       => 'strani z izjemo slik',
	'categorytree-mode-all'         => 'vse strani',
	'categorytree-collapse'         => 'skrci',
	'categorytree-expand'           => 'razširi',
	'categorytree-load'             => 'naloži',
	'categorytree-loading'          => 'nalagam',
	'categorytree-nothing-found'    => 'ni zadetkov',
	'categorytree-no-subcategories' => 'ni podkategorij',
	'categorytree-no-pages'         => 'ni strani ali podkategorij',
	'categorytree-not-found'        => 'Kategorije <i>$1</i> ni moc najti',
	'categorytree-show-list'        => 'Prikaži kot seznam',
	'categorytree-show-tree'        => 'Prikaži kot drevo',
	'categorytree-too-many-subcats' => 'Podkategorij ni moc prikazati kot drevo, saj jih je prevec.',
);

/** Albanian (Shqip) */
$messages['sq'] = array(
	'categorytree'                  => 'Pema e kategorive',
	'categorytree-tab'              => 'Pemë',
	'categorytree-header'           => 'Fusni emrin e Kategorisë për të parë Nënkategoritë si Pemë kategorish. Këtij funksioni i nevoiten JavaScript dhe AJAX për të funksionuar si duhet. Nëse keni një shfletues të vjetër, ose nëse i keni deaktivuar JavaScript kjo nuk do të funksionoj.',
	'categorytree-category'         => 'Kategori',
	'categorytree-go'               => 'Plotëso',
	'categorytree-parents'          => 'Kryekategoritë',
	'categorytree-mode-categories'  => 'vetëm kategoritë',
	'categorytree-mode-pages'       => 'faqet pa figurat',
	'categorytree-mode-all'         => 'të gjitha faqet',
	'categorytree-collapse'         => 'mbylle',
	'categorytree-expand'           => 'hape',
	'categorytree-load'             => 'hape',
	'categorytree-loading'          => 'duke plotësuar',
	'categorytree-nothing-found'    => 'Ju kërkoj ndjesë, nuk u gjet asgjë.',
	'categorytree-no-subcategories' => 'Asnjë nënkategori.',
	'categorytree-no-pages'         => 'Asnjë artikull ose nënkategori.',
	'categorytree-not-found'        => 'Kategoria <i>$1</i> nuk u gjet',
	'categorytree-show-list'        => 'Trego si listë',
	'categorytree-show-tree'        => 'Trego si pemë',
	'categorytree-too-many-subcats' => "Nuk mund t'i tregoj nënkategoritë si pemë, sepse ka shumë prej tyre.",
);

/** Serbian Cyrillic ekavian (ћирилица)
 * @author Sasa Stefanovic
 * @author Siebrand
 */
$messages['sr-ec'] = array(
	'categorytree'                  => 'Дрво категорија',
	'categorytree-tab'              => 'Дрво',
	'categorytree-legend'           => 'Прикажи дрво категорија',
	'categorytree-header'           => 'Унесите име категорији чији садржај желите да видите као дрво.
Ово захтева напредну ЈаваСкрип функцију познату као AJAX.
Уколико имате веома стари браузер, или се искључили ЈаваСкрипт, дрво категорија неће радити.',
	'categorytree-category'         => 'Категорија:',
	'categorytree-go'               => 'Прикажи дрво',
	'categorytree-mode-categories'  => 'само категорије',
	'categorytree-mode-pages'       => 'странице изузев слика',
	'categorytree-mode-all'         => 'све странице',
	'categorytree-collapse'         => 'сакриј',
	'categorytree-expand'           => 'прикажи',
	'categorytree-load'             => 'учитај',
	'categorytree-loading'          => 'учитавање',
	'categorytree-nothing-found'    => 'ништа није пронађено',
	'categorytree-no-subcategories' => 'нема подкатегорија',
	'categorytree-no-pages'         => 'нема страница или подкатегорија',
	'categorytree-not-found'        => 'Категорија <i>$1</i> није пронађена',
	'categorytree-error'            => 'Проблем при учитавању података.',
	'categorytree-retry'            => 'Молимо сачекајте тренутак и покушајте поново',
	'categorytree-show-list'        => 'Прикажи као списак',
	'categorytree-show-tree'        => 'Прикажи као дрво',
	'categorytree-too-many-subcats' => 'Не могу приказати подкатегорије као дрво, има их превише.',
);

/** Southern Sotho (Sesotho)
 * @author SPQRobin
 * @author Siebrand
 */
$messages['st'] = array(
	'categorytree'                  => 'Lenane le Mekga',
	'categorytree-tab'              => 'Lenane',
	'categorytree-category'         => 'Mokga:',
	'categorytree-go'               => 'Mpontshe lenane',
	'categorytree-mode-categories'  => 'mekga feela',
	'categorytree-mode-pages'       => 'maqephe ntle le ditshwantsho',
	'categorytree-collapse'         => 'Nyenyefatsa',
	'categorytree-expand'           => 'Hodisa',
	'categorytree-load'             => 'jara',
	'categorytree-loading'          => 'le ntse le jarwa',
	'categorytree-nothing-found'    => 'Ha ho a fumanwa letho',
	'categorytree-no-subcategories' => 'ntle le mekgana',
	'categorytree-no-pages'         => 'ntle le maqephe le mekgana',
	'categorytree-not-found'        => 'Mokga wa <i>$1</i> ha o a fumanwa',
	'categorytree-show-list'        => 'E hlahise e le lethathama',
	'categorytree-show-tree'        => 'E hlahise e le lenane',
	'categorytree-too-many-subcats' => 'Mekgana e ka se hlahiswe e le lenane hobane e mengata ha holo',
);

/** Seeltersk (Seeltersk)
 * @author Pyt
 * @author Siebrand
 */
$messages['stq'] = array(
	'categorytree'                  => 'Kategorieboom',
	'categorytree-tab'              => 'Boom',
	'categorytree-legend'           => 'Wies Kategorienboom',
	'categorytree-desc'             => 'AJAX-basierd Gadget uum ju [[Special:CategoryTree|Kategorien-Struktuur]] fon n Wiki antouwiesen',
	'categorytree-header'           => 'Wiest foar ju anroate Kategorie do Unnerkategorien in n Boomstruktuur.
Disse Siede bruukt bestimde JavaScript-Funktione (AJAX).
In gjucht oolde Browsere, of wan Javascript ouschalted is, funktioniert disse Siede eventuell nit.',
	'categorytree-category'         => 'Kategorie:',
	'categorytree-go'               => 'Leede',
	'categorytree-parents'          => 'Buppekategorien',
	'categorytree-mode-categories'  => 'bloot Kategorien',
	'categorytree-mode-pages'       => 'Sieden buute Bielden',
	'categorytree-mode-all'         => 'aal Sieden',
	'categorytree-collapse'         => 'ienklappe',
	'categorytree-expand'           => 'uutklappe',
	'categorytree-load'             => 'leede',
	'categorytree-loading'          => 'leede ...',
	'categorytree-nothing-found'    => 'Niks fuunen',
	'categorytree-no-subcategories' => 'Neen Unnerkategorien',
	'categorytree-no-pages'         => 'Neen Sieden of Unnerkategorien',
	'categorytree-not-found'        => "Kategorie ''$1'' nit fuunen",
	'categorytree-error'            => 'Probleme bie dät Leeden fon do Doaten.',
	'categorytree-retry'            => 'Täif ieuwen un fersäik et dan fon näien.',
	'categorytree-show-list'        => 'Wies as Lieste',
	'categorytree-show-tree'        => 'Wies as Boom',
	'categorytree-too-many-subcats' => 'Unnerkategorien konnen nit as Boom deerstoald wäide, deer dät toufuul sunt.',
);

/** Sundanese (Basa Sunda)
 * @author Kandar
 * @author Siebrand
 * @author Irwangatot
 */
$messages['su'] = array(
	'categorytree'                  => 'TangkalKategori',
	'categorytree-tab'              => 'Tangkal',
	'categorytree-legend'           => 'Témbongkeun tangkal kategori',
	'categorytree-desc'             => 'Gajet AJAX pikeun némbongkeun [[Special:CategoryTree|wangun kategori]] dina hiji wiki',
	'categorytree-header'           => 'Asupkeun hiji ngaran kategori pikeun nempo eusina dina wangun tangkal.
Perhatikeun yén fitur ieu merlukeun pangrojong Javascript tingkat tuluy anu dipikawanoh minangka AJAX.
Lamun Anjeun ngagunakeun panyungsi nu lila, atawa maehan fungsi Javascript Anjeun, fitur ieu henteu bisa dijalankeun.',
	'categorytree-category'         => 'Kategori:',
	'categorytree-go'               => 'Témbongkeun Tangkal',
	'categorytree-parents'          => 'Luluhur',
	'categorytree-mode-categories'  => 'kategori wungkul',
	'categorytree-mode-pages'       => 'kaca iwal gambar',
	'categorytree-mode-all'         => 'sadaya kaca',
	'categorytree-collapse'         => 'tilep',
	'categorytree-expand'           => 'buka',
	'categorytree-load'             => 'muatkeun',
	'categorytree-loading'          => 'ngamuat',
	'categorytree-nothing-found'    => 'teu manggih nanaon',
	'categorytree-no-subcategories' => 'euweuh subkategori',
	'categorytree-no-pages'         => 'euweuh kaca atawa subkategori',
	'categorytree-not-found'        => 'Kategori <i>$1</i> teu kapanggih',
	'categorytree-error'            => 'Aya masalah dina ngamuat data.',
	'categorytree-retry'            => 'Dago sakedap, lajeng coba deui.',
	'categorytree-show-list'        => 'Béréndélkeun',
	'categorytree-show-tree'        => 'Témbongkeun salaku tangkal',
	'categorytree-too-many-subcats' => 'Loba teuing subkategori, teu bisa dipidangkeun dina wanda tangkal.',
);

/** Swedish (Svenska)
 * @author Sannab
 * @author Lejonel
 * @author Jon Harald Søby
 * @author M.M.S.
 * @author Siebrand
 */
$messages['sv'] = array(
	'categorytree'                  => 'Kategoriträd',
	'categorytree-tab'              => 'Träd',
	'categorytree-legend'           => 'Visa kategoriträd',
	'categorytree-desc'             => 'AJAX-baserat verktyg som visar [[Special:CategoryTree|kategoristrukturen]] på en wiki',
	'categorytree-header'           => 'Fyll i ett kategorinamn för att se dess innehåll som en trädstruktur.
Notera att detta kräver stöd för AJAX, en avancerad form av JavaScript.
Därför fungerar funktionen inte i mycket gamla webbläsare eller om JavaScript är avaktiverat.',
	'categorytree-category'         => 'Kategori:',
	'categorytree-go'               => 'Visa träd',
	'categorytree-parents'          => 'Föräldrakategorier',
	'categorytree-mode-categories'  => 'visa bara kategorier',
	'categorytree-mode-pages'       => 'sidor utom bilder',
	'categorytree-mode-all'         => 'alla sidor',
	'categorytree-collapse'         => 'göm',
	'categorytree-expand'           => 'expandera',
	'categorytree-load'             => 'ladda',
	'categorytree-loading'          => 'laddar',
	'categorytree-nothing-found'    => 'hittade inget',
	'categorytree-no-subcategories' => 'inga underkategorier',
	'categorytree-no-pages'         => 'inga artiklar eller underkategorier',
	'categorytree-not-found'        => "Kategori ''$1'' hittades ej",
	'categorytree-error'            => 'Problem med att ladda data.',
	'categorytree-retry'            => 'Vänta en stund och försök igen.',
	'categorytree-show-list'        => 'Visa som lista',
	'categorytree-show-tree'        => 'Visa som träd',
	'categorytree-too-many-subcats' => 'Kan inte visa underkategorier som ett träd eftersom det finns för många.',
);

/** Tamil (தமிழ்)
 * @author Trengarasu
 * @author Siebrand
 */
$messages['ta'] = array(
	'categorytree'                  => 'பகுப்பு மரம்',
	'categorytree-category'         => 'பகுப்பு:',
	'categorytree-go'               => 'மரத்தைக் காட்டு',
	'categorytree-no-subcategories' => 'துணைப்பகுப்புகள் கிடையாது',
	'categorytree-no-pages'         => 'பக்கங்களோ அல்லது துணைப்பகுப்புகளோ கிடையாது',
	'categorytree-not-found'        => '<i>$1</i> பகுப்பு காணப்படவில்லை',
);

/** Telugu (తెలుగు)
 * @author Mpradeep
 * @author Veeven
 * @author వైజాసత్య
 * @author Siebrand
 */
$messages['te'] = array(
	'categorytree'                  => 'వర్గవృక్షం',
	'categorytree-tab'              => 'వృక్షం',
	'categorytree-legend'           => 'వర్గ వృక్షాన్ని చూపించు',
	'categorytree-desc'             => 'వికీ యొక్క [[Special:CategoryTree|వర్గ వృక్షాన్ని]] చూపించడానికి AJAX ఆధారిత పరికరం',
	'categorytree-header'           => 'ఒక వర్గంలోని అంశాలను వృక్షం లాగా చూసేందుకు ఆ వర్గం పేరును ఇక్కడ ఇవ్వండి. దీనికోసం AJAX అనే ఆధునిక జావాస్క్రిప్టు నైపుణ్యం కావాలి. మీ బ్రౌజరు బాగా పాతదయినా, లేక దానిలో జావాస్క్రిప్టు అశక్తంగా ఉన్నా ఇది పనిచెయ్యదు.',
	'categorytree-category'         => 'వర్గం:',
	'categorytree-go'               => 'వృక్షాన్ని చూపించు',
	'categorytree-parents'          => 'మాతృవర్గాలు',
	'categorytree-mode-categories'  => 'వర్గాలు మాత్రమే',
	'categorytree-mode-pages'       => 'బొమ్మలను మినహాయించి మిగిలిన పేజీలు',
	'categorytree-mode-all'         => 'అన్ని పేజీలు',
	'categorytree-collapse'         => 'మూసివేయి',
	'categorytree-expand'           => 'విస్తరించు',
	'categorytree-load'             => 'లోడు చెయ్యి',
	'categorytree-loading'          => 'లోడవుతూంది',
	'categorytree-nothing-found'    => 'ఏమీ లేవు',
	'categorytree-no-subcategories' => 'ఉపవర్గాలు లేవు',
	'categorytree-no-pages'         => 'పేజీలు గానీ, ఉపవర్గాలు గానీ లేవు',
	'categorytree-not-found'        => '<i>$1</i> అనే వర్గం కనపడలేదు',
	'categorytree-error'            => 'డేటా లోడు చెయ్యడంలో లోపం దొర్లింది',
	'categorytree-retry'            => 'కాస్త ఆగి మళ్ళీ ప్రయత్నించండి.',
	'categorytree-show-list'        => 'జాబితాగా చూపించు',
	'categorytree-show-tree'        => 'వృక్షంగా చూపించు',
	'categorytree-too-many-subcats' => 'ఉపవర్గాలు మరీ ఎక్కువగా ఉన్నాయి, వాటన్నిటినీ వృక్షం లాగా చూపించలేము',
);

/** Tetum (Tetun)
 * @author MF-Warburg
 * @author Siebrand
 */
$messages['tet'] = array(
	'categorytree'                 => 'Ai-hun kategoria',
	'categorytree-tab'             => 'Ai-hun',
	'categorytree-category'        => 'Kategoria:',
	'categorytree-go'              => 'Hatudu ai-hun',
	'categorytree-mode-categories' => "hatudu de'it kategoria",
	'categorytree-mode-all'        => 'pájina hotu',
);

/** Tajik (Cyrillic) (Тоҷикӣ/tojikī (Cyrillic))
 * @author Ibrahim
 * @author Siebrand
 */
$messages['tg-cyrl'] = array(
	'categorytree'                  => 'ГурӯҳДарахт',
	'categorytree-tab'              => 'Дарахт',
	'categorytree-legend'           => 'Намоиши дарахти гурӯҳ',
	'categorytree-desc'             => 'Абзоре дар асоси AJAX барои намоиши [[Special:CategoryTree|сохтори гурӯҳи]] вики.',
	'categorytree-header'           => 'Номи як гурӯҳро ворид кунед, то мӯҳтавиёти он ба сурати дарахт намоиш ёбад.
Таваҷҷӯҳ кунед, ки ин кор ба қобилиятҳои пешрафтаи ҶаваСкрипт бо номи Аҷакс ниёз дорад.
Агар аз мурургари хеле кӯҳна истифода мекунед ё ҶаваСкриптро ғайрифаъол кардаед, дар ин ҳол он кор нахоҳад кард.',
	'categorytree-category'         => 'Гурӯҳ:',
	'categorytree-go'               => 'Намоиши дарахт',
	'categorytree-parents'          => 'Волидайн',
	'categorytree-mode-categories'  => 'Фақат гурӯҳҳо',
	'categorytree-mode-pages'       => 'Саҳифаҳо ғайр аз аксҳо',
	'categorytree-mode-all'         => 'ҳамаи саҳифаҳо',
	'categorytree-collapse'         => 'фурукаш',
	'categorytree-expand'           => 'густариш',
	'categorytree-load'             => 'бор кардан',
	'categorytree-loading'          => 'дар ҳоли бор шудан…',
	'categorytree-nothing-found'    => 'ҳеҷчиз ёфт нашуд',
	'categorytree-no-subcategories' => 'ҳеҷ зергурӯҳе надорад',
	'categorytree-no-pages'         => 'ҳеҷ саҳифае ё зергурӯҳе',
	'categorytree-not-found'        => 'Гурӯҳи <i>$1</i> ёфт нашуд',
	'categorytree-error'            => 'Ишкол дар дарёфти иттилоот',
	'categorytree-retry'            => 'Лутфан чанд лаҳза сабр кунед ва дубора имтиҳон кунед.',
	'categorytree-show-list'        => 'Намоиш ҳамчун феҳрист',
	'categorytree-show-tree'        => 'Намоиш ҳамчун дарахт',
	'categorytree-too-many-subcats' => 'Ба хотири шумораи зиёди онҳо, наметавон зергурӯҳоро ҳамчун дарахт нишон дод.',
);

/** Thai (ไทย)
 * @author Manop
 * @author Passawuth
 */
$messages['th'] = array(
	'categorytree-legend'           => 'แสดงผังหมวดหมู่',
	'categorytree-category'         => 'หมวดหมู่',
	'categorytree-go'               => 'โหลด',
	'categorytree-parents'          => 'หมวดหมู่ใหญ่',
	'categorytree-mode-categories'  => 'แสดงเฉพาะหมวดหมู่',
	'categorytree-nothing-found'    => 'ไม่พบที่ต้องการ',
	'categorytree-no-subcategories' => 'ไม่มีหมวดหมู่ย่อย',
	'categorytree-no-pages'         => 'ไม่มีบทความหรือหมวดหมู่ย่อย',
	'categorytree-error'            => 'การโหลดข้อมูลมีปัญหา',
	'categorytree-retry'            => 'กรุณารอสักครู่ แล้วลองโหลดใหม่อีกครั้ง',
);

/** Tonga (faka-Tonga)
 * @author SPQRobin
 * @author Siebrand
 */
$messages['to'] = array(
	'categorytree'          => 'Fuʻuʻakau faʻahinga',
	'categorytree-category' => 'Faʻahinga:',
	'categorytree-go'       => 'ʻAsi mai',
	'categorytree-collapse' => 'holo',
	'categorytree-expand'   => 'fano',
);

/** Turkish (Türkçe)
 * @author SPQRobin
 * @author Runningfridgesrule
 * @author Mach
 */
$messages['tr'] = array(
	'categorytree'                  => 'Kategori hiyerarşisi',
	'categorytree-tab'              => 'Hiyerarşik',
	'categorytree-legend'           => 'Kategori ağacını göster',
	'categorytree-header'           => 'Kategori ismini girip, içeriğini hiyerarşik şekilde görebilirsiniz. Bu özellik AJAX adıyla bilinen gelişmiş JavaScript ile çalışabilir. Eğer tarayıcınız eski ise ya da JavaScript kullanımı kapalı ise, çalışmaz.',
	'categorytree-category'         => 'Kategori',
	'categorytree-go'               => 'Yükle',
	'categorytree-parents'          => 'Üst kategoriler',
	'categorytree-mode-categories'  => 'sadece kategorileri göster',
	'categorytree-mode-pages'       => 'resimler dışındaki sayfalar',
	'categorytree-mode-all'         => 'tüm sayfalar',
	'categorytree-collapse'         => 'aç/kapat',
	'categorytree-expand'           => 'genişlet',
	'categorytree-load'             => 'yükle',
	'categorytree-loading'          => 'yükleniyor',
	'categorytree-nothing-found'    => 'maalesef, sonuç yok',
	'categorytree-no-subcategories' => 'alt kategori yok.',
	'categorytree-no-pages'         => 'alt kategori veya madde yok.',
	'categorytree-not-found'        => '<i>"$1"</i> isimli kategori bulunamadı',
	'categorytree-retry'            => 'Lütfen kısa süre için bekleyin, sonra bir kere daha deneyin.',
	'categorytree-show-list'        => 'Liste olarak göster',
	'categorytree-show-tree'        => 'Hiyerarşik olarak göster',
	'categorytree-too-many-subcats' => 'Çok fazla nesne olduğundan, hiyerarşik olarak gösterilemiyor.',
);

/** Ukrainian (Українська)
 * @author Ahonc
 */
$messages['uk'] = array(
	'categorytree'                  => 'Дерево категорій',
	'categorytree-tab'              => 'Дерево',
	'categorytree-legend'           => 'Показати дерево категорій',
	'categorytree-desc'             => 'AJAX-компонент для відображення [[Special:CategoryTree|структури категорій]] вікі',
	'categorytree-header'           => 'Уведіть назву категорії, і вона буде показана у вигляді дерева.
Ця можливість доступна, тільки якщо ваш браузер підтримує AJAX.
Якщо у вас стара версія браузера або відключений JavaScript, відображення підкатегорій у вигляді дерева недоступне.',
	'categorytree-category'         => 'Категорія:',
	'categorytree-go'               => 'Показати дерево',
	'categorytree-parents'          => 'Батьківські категорії',
	'categorytree-mode-categories'  => 'тільки категорії',
	'categorytree-mode-pages'       => 'окрім зображень',
	'categorytree-mode-all'         => 'усі сторінки',
	'categorytree-collapse'         => 'згорнути',
	'categorytree-expand'           => 'розгорнути',
	'categorytree-load'             => 'завантажити',
	'categorytree-loading'          => 'завантаження…',
	'categorytree-nothing-found'    => 'Ця категорія не містить підкатегорій.',
	'categorytree-no-subcategories' => 'нема підкатегорій',
	'categorytree-no-pages'         => 'нема статей і підкатегорій',
	'categorytree-not-found'        => 'Категорія «$1» не знайдена.',
	'categorytree-error'            => 'Помилка завантаження даних.',
	'categorytree-retry'            => 'Будь ласка, зачекайте і спробуйте ще раз.',
	'categorytree-show-list'        => 'Список',
	'categorytree-show-tree'        => 'Дерево',
	'categorytree-too-many-subcats' => 'Неможливо показати підкатегорії у вигляді дерева — їх дуже багато.',
);

/** Urdu (اردو) */
$messages['ur'] = array(
	'categorytree'                  => 'شجر ِزمرہ',
	'categorytree-tab'              => 'شجر',
	'categorytree-category'         => 'زمرہ',
	'categorytree-go'               => 'بہ ترتیب شجر',
	'categorytree-mode-all'         => 'تمام صفحات',
	'categorytree-load'             => 'اثقال',
	'categorytree-loading'          => 'دوران اثقال',
	'categorytree-nothing-found'    => 'کچھ دستیاب نہیں',
	'categorytree-no-subcategories' => 'کوئی ذیلی زمرہ نہیں',
	'categorytree-show-list'        => 'بہ ترتیب فہرست',
	'categorytree-show-tree'        => 'بہ ترتیب شجر',
	'categorytree-too-many-subcats' => 'ذیلی زمرہ جات کی تعداد کثیر کے باعث بہ ترتیب شجر نہیں کیا جاسکتا',
);

/** Vèneto (Vèneto)
 * @author Candalua
 */
$messages['vec'] = array(
	'categorytree'                  => 'Strutura ad àlbaro de le categorie',
	'categorytree-tab'              => 'Àlbaro',
	'categorytree-legend'           => "Mostra l'àlbaro de le categorie",
	'categorytree-desc'             => 'Acessorio AJAX par visualizar la [[Special:CategoryTree|strutura de le categorie]] del sito',
	'categorytree-header'           => 'Inserissi el nome de la categoria de cui te vol védar el contenuto soto forma de strutura ad àlbaro. Nota che la pagina la richiede le funzionalità avanzade de JavaScript ciamà AJAX; se te stè doparando un browser vecio assè o le funzion JavaScript le xe disabilità, sta pagina no la funzionarà mìa.',
	'categorytree-category'         => 'Categoria',
	'categorytree-go'               => "Mostra l'àlbaro",
	'categorytree-parents'          => 'Categorie superiori',
	'categorytree-mode-categories'  => 'mostra solo le categorie',
	'categorytree-mode-pages'       => 'tute le pagine, via de le imagini',
	'categorytree-mode-all'         => 'tute le pagine',
	'categorytree-collapse'         => 'conprimi',
	'categorytree-expand'           => 'espandi',
	'categorytree-load'             => 'carga',
	'categorytree-loading'          => 'sto cargando…',
	'categorytree-nothing-found'    => 'nissun risultato',
	'categorytree-no-subcategories' => 'nissuna sotocategoria',
	'categorytree-no-pages'         => 'nissuna voçe né sotocategoria',
	'categorytree-not-found'        => 'Categoria <i>$1</i> mìa catà',
	'categorytree-error'            => 'Ghe xe un problema nel caricamento dei dati.',
	'categorytree-retry'            => "Speta n'atimo e dopo próa de novo.",
	'categorytree-show-list'        => 'Mostra come lista',
	'categorytree-show-tree'        => 'Mostra come àlbaro',
	'categorytree-too-many-subcats' => 'Ghe xe massa categorie par mostrarle ad àlbaro.',
);

/** Vietnamese (Tiếng Việt)
 * @author Vinhtantran
 * @author Minh Nguyen
 */
$messages['vi'] = array(
	'categorytree'                  => 'Cây thể loại',
	'categorytree-tab'              => 'Cây',
	'categorytree-legend'           => 'Hiển thị cây thể loại',
	'categorytree-desc'             => 'Công cụ AJAX để hiển thị [[Special:CategoryTree|cấu trúc thể loại]] của một wiki',
	'categorytree-header'           => 'Gõ vào tên thể loại để xem nội dung của nó theo cấu trúc cây.
Chú ý rằng chức năng này sử dụng chức năng JavaScript, với tên AJAX.
Nếu bạn đang sử dụng trình duyệt rất cũ, hoặc đã tắt JavaScript, nó sẽ không hoạt động.',
	'categorytree-category'         => 'Thể loại:',
	'categorytree-go'               => 'Hiển thị',
	'categorytree-parents'          => 'Các thể loại mẹ',
	'categorytree-mode-categories'  => 'Chỉ liệt kê các thể loại',
	'categorytree-mode-pages'       => 'các trang ngoại trừ trang hình',
	'categorytree-mode-all'         => 'tất cả các trang',
	'categorytree-collapse'         => 'đóng',
	'categorytree-expand'           => 'mở',
	'categorytree-load'             => 'tải',
	'categorytree-loading'          => 'đang tải',
	'categorytree-nothing-found'    => 'Không có gì.',
	'categorytree-no-subcategories' => 'Không có tiểu thể loại.',
	'categorytree-no-pages'         => 'Không có trang hay tiểu thể loại.',
	'categorytree-not-found'        => 'Không tìm thấy thể loại <i>$1</i>',
	'categorytree-error'            => 'Có vấn đề khi tải dữ liệu.',
	'categorytree-retry'            => 'Xin hãy chờ một chút rồi thử lại.',
	'categorytree-show-list'        => 'Hiển thị dạng danh sách',
	'categorytree-show-tree'        => 'Hiển thị dạng cây',
	'categorytree-too-many-subcats' => 'Không thể hiển thị tiểu thể loại theo dạng cây, có quá nhiều tiểu thể loại',
);

/** Volapük (Volapük)
 * @author Malafaya
 * @author Smeira
 * @author Siebrand
 */
$messages['vo'] = array(
	'categorytree'                  => 'KladaBim',
	'categorytree-tab'              => 'Bim',
	'categorytree-legend'           => 'Jonolöd kladabimi',
	'categorytree-header'           => 'Penolös kladanemi ad logön ninädi klada as bimabinod. Küpälolös, das atos flagon dili ela JavaScript labü nem: AJAX. No oplöpon if labol bevüresodanafömi vönädik, ud if enemogüköl eli JavaScript.',
	'categorytree-category'         => 'Klad:',
	'categorytree-go'               => 'Jonolöd Bimi',
	'categorytree-parents'          => 'Pals',
	'categorytree-mode-categories'  => 'Te klads',
	'categorytree-mode-pages'       => 'pads pläamü magods',
	'categorytree-mode-all'         => 'pads valik',
	'categorytree-collapse'         => 'brefükön',
	'categorytree-expand'           => 'stäänükön',
	'categorytree-load'             => 'lodön',
	'categorytree-loading'          => 'lodam',
	'categorytree-nothing-found'    => 'nos petuvon',
	'categorytree-no-subcategories' => 'donaklads nonik',
	'categorytree-no-pages'         => 'pads e donaklads noniks',
	'categorytree-not-found'        => 'Klad: <i>$1</i> no petuvöl',
	'categorytree-error'            => 'No eplöpos ad lodön nünis.',
	'categorytree-retry'            => 'Stebedolös, begö! timüli e steifülolös dönu.',
	'categorytree-show-list'        => 'Jonön as lised',
	'categorytree-show-tree'        => 'Jonön as bim',
	'categorytree-too-many-subcats' => 'Donaklads no kanons pajonön as bim, bi binons tu mödiks.',
);

/** Wu (吴语)
 * @author Wtzdj
 */
$messages['wuu'] = array(
	'categorytree'                  => '分类树',
	'categorytree-tab'              => '树形',
	'categorytree-category'         => '分类',
	'categorytree-go'               => '显示树形',
	'categorytree-mode-categories'  => '仅分类',
	'categorytree-mode-pages'       => '除脱图片以外个页面',
	'categorytree-mode-all'         => '所有页面',
	'categorytree-collapse'         => '抈出来',
	'categorytree-expand'           => '放开来',
	'categorytree-nothing-found'    => '一样也朆寻着',
	'categorytree-no-subcategories' => '呒拨子分类',
	'categorytree-no-pages'         => '呒拨页面或者子分类',
	'categorytree-show-list'        => '显示成功列表',
	'categorytree-show-tree'        => '显示成功树',
	'categorytree-too-many-subcats' => '子分类忒多哉，显示弗过来哉。',
);

/** Cantonese (廣東話)
 * @author Shinjiman
 */
$messages['yue'] = array(
	'categorytree'                  => '分類樹',
	'categorytree-tab'              => '樹',
	'categorytree-legend'           => '顯示分類樹',
	'categorytree-desc'             => '一個以AJAX為主嘅小工具去顯示響一個wiki嘅[[Special:CategoryTree|分類架構]]',
	'categorytree-header'           => '輸入分類名去睇佢嘅樹形結構內容。
請留意呢個係需要進階嘅JavaScript功能叫做AJAX。
如果你係有一個好舊嘅瀏覽器，又或者停用咗JavaScript，咁就會用唔到。',
	'categorytree-category'         => '分類',
	'categorytree-go'               => '載入',
	'categorytree-parents'          => '父分類',
	'categorytree-mode-categories'  => '只顯示分類',
	'categorytree-mode-pages'       => '除咗圖像之外嘅版',
	'categorytree-mode-all'         => '全版',
	'categorytree-collapse'         => '收埋',
	'categorytree-expand'           => '打開',
	'categorytree-load'             => '載入',
	'categorytree-loading'          => '載入緊',
	'categorytree-nothing-found'    => '搵唔到任何嘢',
	'categorytree-no-subcategories' => '冇細分類',
	'categorytree-no-pages'         => '冇文章或者細分類',
	'categorytree-not-found'        => '搵唔到<i>$1</i>分類',
	'categorytree-error'            => '載入資料嗰陣發生咗錯誤。',
	'categorytree-retry'            => '請等多一陣再試過。',
	'categorytree-show-list'        => '顯示做表',
	'categorytree-show-tree'        => '顯示做樹',
	'categorytree-too-many-subcats' => '唔可以將細分類顯示做樹，因為已經有太多喇。',
);

/** Simplified Chinese (‪中文(简体)‬)
 * @author Shinjiman
 */
$messages['zh-hans'] = array(
	'categorytree'                  => '分类树',
	'categorytree-tab'              => '树形目录',
	'categorytree-legend'           => '显示分类树',
	'categorytree-desc'             => '以AJAX技术显示[[Special:CategoryTree|分类结构]]',
	'categorytree-header'           => '在此可以查询以分类的树形结构。
注意： 本特殊页面使用AJAX技术。
如果您的浏览器非常老旧，或者是关闭了JavaScript，本页面将会无法正常运作。',
	'categorytree-category'         => '分类',
	'categorytree-go'               => '显示树形结构',
	'categorytree-parents'          => '上级分类',
	'categorytree-mode-categories'  => '只显示分类',
	'categorytree-mode-pages'       => '除去图像页面',
	'categorytree-mode-all'         => '所有页面',
	'categorytree-collapse'         => '折叠',
	'categorytree-expand'           => '展开',
	'categorytree-load'             => '装载',
	'categorytree-loading'          => '装载中',
	'categorytree-nothing-found'    => '搜索结果为空',
	'categorytree-no-subcategories' => '没有子分类。',
	'categorytree-no-pages'         => '没有文章或是子分类。',
	'categorytree-not-found'        => '找不到分类<i>$1</i>',
	'categorytree-error'            => '载入数据时发生错误。',
	'categorytree-retry'            => '请稍候一会，然后再试。',
	'categorytree-show-list'        => '以列表显示',
	'categorytree-show-tree'        => '以树形显示',
	'categorytree-too-many-subcats' => '无法以树形显示子分类，因为已经有太多了。',
);

/** Traditional Chinese (‪中文(繁體)‬)
 * @author Shinjiman
 * @author Alexsh
 */
$messages['zh-hant'] = array(
	'categorytree'                  => '分類樹',
	'categorytree-tab'              => '樹狀目錄',
	'categorytree-legend'           => '顯示分類樹',
	'categorytree-desc'             => '以AJAX技術顯示[[Special:CategoryTree|分類結構]]',
	'categorytree-header'           => '在此可以查詢以分類的樹狀結構。
注意： 本特殊頁面使用AJAX技術。
如果您的瀏覽器非常老舊，或者是關閉了JavaScript，本頁面將會無法正常運作。',
	'categorytree-category'         => '分類',
	'categorytree-go'               => '顯示樹狀結構',
	'categorytree-parents'          => '父分類',
	'categorytree-mode-categories'  => '只顯示分類',
	'categorytree-mode-pages'       => '除去圖像頁面',
	'categorytree-mode-all'         => '所有頁面',
	'categorytree-collapse'         => '摺疊',
	'categorytree-expand'           => '展開',
	'categorytree-load'             => '載入',
	'categorytree-loading'          => '載入中',
	'categorytree-nothing-found'    => '找不到任何項目',
	'categorytree-no-subcategories' => '沒有子分類',
	'categorytree-no-pages'         => '沒有頁面或子分類',
	'categorytree-not-found'        => '找不到分類<i>$1</i>',
	'categorytree-error'            => '載入資料時發生錯誤。',
	'categorytree-retry'            => '請稍候一會，然後再試。',
	'categorytree-show-list'        => '以清單顯示',
	'categorytree-show-tree'        => '以樹狀顯示',
	'categorytree-too-many-subcats' => '無法以樹狀顯示子分類，因為已經有太多了。',
);

/** Zulu (isiZulu)
 * @author SPQRobin
 */
$messages['zu'] = array(
	'categorytree-collapse' => 'Nciphisa',
	'categorytree-expand'   => 'Khulisa',
);

