function brg(x) {
    x.classList.toggle("change");
}

$(document).ready(function(){
    $('div.account-burger').click(function(){
        $("div.account-click").toggleClass('show-account');
    });
});

//add new employment history
$(".add-history").click(function(){
    $("table.history tbody").append('<tr><td><select class="form-control" name="job_title[]"><optgroup label="Computer Jobs"></optgroup><optgroup label="Graphic Design"><option value="Freehand">Freehand</option><option value="Illustrator">Illustrator</option><option value="InDesign">InDesign</option><option value="Photoshop">Photoshop</option></optgroup><optgroup label="Software"><option value="Acrobat">Acrobat</option><option value="Autocad">Autocad</option><option value="Axapta">Axapta</option><option value="Concord">Concord</option><option value="DK">DK</option><option value="Excel">Excel</option><option value="Lotus Notes / IBM Notes">Lotus Notes / IBM Notes</option><option value="Navision">Navision</option><option value="Outlook">Outlook</option><option value="Powerpoint">Powerpoint</option><option value="Publisher">Publisher</option><option value="Word">Word</option></optgroup><optgroup label="System Management"><option value="Mac OS">Mac OS</option><option value="Linux">Linux</option><option value="Oracle">Oracle</option><option value="Windows">Windows</option></optgroup><optgroup label="Web Development/Design"><option value="Codeigniter">Codeigniter</option><option value="Dreamweaver">Dreamweaver</option><option value="Joomla">Joomla</option><option value="Laravel">Laravel</option><option value="Wordpress">Wordpress</option></optgroup><optgroup label="Webmaster"><option value="Webmaster">Webmaster</option></optgroup><optgroup label="Driving Jobs"><option value="Driver">Driver</option></optgroup><optgroup label="Industrial Jobs"><option value="Bifreiðasmiður">Bifreiðasmiður</option><option value="Bílamálun">Bílamálun</option><option value="Building Jobs">Building Jobs</option><option value="Car Mechanics">Car Mechanics</option><option value="Carpentry">Carpentry</option><option value="Device Controller">Device Controller</option><option value="Electrical">Electrical</option><option value="Electronic">Electronic</option><option value="Engineering">Engineering</option><option value="Farm Work">Farm Work</option><option value="Gardening">Gardening</option><option value="House Painting">House Painting</option><option value="Joinery">Joinery</option><option value="Machinery">Machinery</option><option value="Mechanics">Mechanics</option><option value="Metal Products">Metal Products</option><option value="Paint Jobs">Paint Jobs</option></optgroup><optgroup label="Management Jobs"><option value="CFO">CFO</option><option value="Chief Executive Officer">Chief Executive Officer</option><option value="Director">Director</option><option value="Foreman">Foreman</option><option value="Head of Department">Head of Department</option><option value="Inventory Manager">Inventory Manager</option><option value="Manager">Manager</option><option value="Marketing">Marketing</option><option value="Marketing Manager">Marketing Manager</option><option value="Office Manager">Office Manager</option><option value="Project Manager">Project Manager</option><option value="Purchasing">Purchasing</option></optgroup><optgroup label="Office Jobs"><option value="Accounting">Accounting</option><option value="Billing">Billing</option><option value="Clerk">Clerk</option><option value="Personnel">Personnel</option><option value="Reception">Reception</option><option value="Secretarial">Secretarial</option><option value="Shipping Fleet">Shipping Fleet</option><option value="Shopping">Shopping</option><option value="Treasurer">Treasurer</option><option value="Service Center">Service Center</option></optgroup><optgroup label="Sales Jobs"><option value="Phone Sales">Phone Sales</option><option value="Sales Management">Sales Management</option><option value="Sales Outside">Sales Outside</option></optgroup><optgroup label="Service Jobs"><option value="Culinary Jobs">Culinary Jobs</option><option value="Janitor">Janitor</option><option value="Reception">Reception</option><option value="Security Patrols">Security Patrols</option></optgroup><optgroup label="Trade Jobs"><option value="Public Service">Public Service</option><option value="Trade Management">Trade Management</option></optgroup><optgroup label="Teaching Jobs"><option value="College Professor/Instructor">College Professor/Instructor</option><option value="Primary School Teacher">Primary School Teacher</option><option value="Kindergarten Teacher">Kindergarten Teacher</option></optgroup><optgroup label="Others"><option value="Advertising Model">Advertising Model</option><option value="Architect">Architect</option><option value="Business Administration">Business Administration</option><option value="Economics">Economics</option><option value="Engineering Jobs">Engineering Jobs</option><option value="Fish Processing">Fish Processing</option><option value="Jobs Market">Jobs Market</option><option value="Lagerstörf">Lagerstörf</option><option value="Law">Law</option><option value="Logistics">Logistics</option><option value="Nursing">Nursing</option><option value="Paramedic">Paramedic</option><option value="Pharmacy">Pharmacy</option><option value="Pharmacy Technician">Pharmacy Technician</option><option value="Production Jobs">Production Jobs</option><option value="Public Relations">Public Relations</option><option value="Publications">Publications</option><option value="Seafaring">Seafaring</option><option value="Social Care">Social Care</option><option value="Technical Drawing">Technical Drawing</option><option value="Verkamannastörf"> Verkamannastörf</option></optgroup></select></td><td><textarea placeholder="Job Description" cols="50" rows="10" name="job_description[]" class="form-control"></textarea></td><td><input type="text" name="jdn[]" id="jdn" class="form-control col-md-4"><select name="jdmmyy[]" id="jdmmyy" class="form-control"><option value="year/s">year/s</option><option value="month/s">month/s</option></select></td><td><input type="text" placeholder="Company" name="company[]" class="form-control" /></td><td><input type="button" class="pull-right delete-history btn theme-btn-dk" value="-"/></td></tr>');
});

$("table.history tbody").on('click','.delete-history',function(){
    $(this).parent().parent().remove();
});

var loc_counter = 1;
//add new work location
$(".add-location").click(function(){
    $("table.location tbody").append("<tr><th> </th><td><select class='form-control' id='state"+loc_counter+"' name ='location[]'></select></td><td><input type='button' class='pull-right delete-location btn theme-btn-dk' value='-'/></td></tr>");
    //populateStates('country', 'state'+loc_counter);
    populateIcelandicStates('state'+loc_counter);
    loc_counter += 1;
});

$("table.location tbody").on('click','.delete-location',function(){
    loc_counter -= 1;
    $(this).parent().parent().remove();
});

var deg_counter = 1;
//add new education history
$(".add-educ").click(function(){
    $("table.educ tbody").append("<tr><td><input required class='form-control' placeholder='School Name' name='school_name[]' type='text'><td><input required placeholder='Course/Degree' class='form-control' name='degree[]' type='text'></td><td><select required id='hda-s-n"+deg_counter+"' class='form-control' name='highest_degree_attained[]'></select></td><td><select name='year_graduated[]' id='yearpicker' class='form-control yearpicker'></select></td><td><input type='button' class='pull-right delete-educ btn theme-btn-dk' value='-'/></td></tr>");
    
    //Copy options from highestdegreeattained default select to previously added select box
    var $options = $("#hidden_hda > option").clone();
    $('#hda-s-n'+deg_counter).append($options);
    deg_counter += 1;

    for (i = new Date().getFullYear(); i > 1900; i--)
    {
        $('.yearpicker').append($('<option />').val(i).html(i));
    }
});

$("table.educ tbody").on('click','.delete-educ',function(){
    deg_counter -= 1;
    $(this).parent().parent().remove();
});

//add new certificate
$(".add-cert").click(function(){
    $("table.cert tbody").append("<tr><th><label for='cv'>Upload a resume or a certificate:</label> <input name='cv[]' type='file' id='cv'></th><td><label for='emp_cv'>Resume / Certificate</label> <select class='form-control' name='cv_type[]'><option value='resume'>Resume</option><option value='certificate'>Certificate</option></select></td><td><input type='button' class='pull-right delete-cert btn theme-btn-dk' value='-'/></td></tr>");
});

$("table.cert tbody").on('click','.delete-cert',function(){
    $(this).parent().parent().remove();
});

$(document).ready(function(){
// THE JSON ARRAY.
var lang = [
{"code":"ab","name":"Abkhaz","nativeName":"аҧсуа"},
{"code":"aa","name":"Afar","nativeName":"Afaraf"},
{"code":"af","name":"Afrikaans","nativeName":"Afrikaans"},
{"code":"ak","name":"Akan","nativeName":"Akan"},
{"code":"sq","name":"Albanian","nativeName":"Shqip"},
{"code":"am","name":"Amharic","nativeName":"አማርኛ"},
{"code":"ar","name":"Arabic","nativeName":"العربية"},
{"code":"an","name":"Aragonese","nativeName":"Aragonés"},
{"code":"hy","name":"Armenian","nativeName":"Հայերեն"},
{"code":"as","name":"Assamese","nativeName":"অসমীয়া"},
{"code":"av","name":"Avaric","nativeName":"авар мацӀ, магӀарул мацӀ"},
{"code":"ae","name":"Avestan","nativeName":"avesta"},
{"code":"ay","name":"Aymara","nativeName":"aymar aru"},
{"code":"az","name":"Azerbaijani","nativeName":"azərbaycan dili"},
{"code":"bm","name":"Bambara","nativeName":"bamanankan"},
{"code":"ba","name":"Bashkir","nativeName":"башҡорт теле"},
{"code":"eu","name":"Basque","nativeName":"euskara, euskera"},
{"code":"be","name":"Belarusian","nativeName":"Беларуская"},
{"code":"bn","name":"Bengali","nativeName":"বাংলা"},
{"code":"bh","name":"Bihari","nativeName":"भोजपुरी"},
{"code":"bi","name":"Bislama","nativeName":"Bislama"},
{"code":"bs","name":"Bosnian","nativeName":"bosanski jezik"},
{"code":"br","name":"Breton","nativeName":"brezhoneg"},
{"code":"bg","name":"Bulgarian","nativeName":"български език"},
{"code":"my","name":"Burmese","nativeName":"ဗမာစာ"},
{"code":"ca","name":"Catalan; Valencian","nativeName":"Català"},
{"code":"ch","name":"Chamorro","nativeName":"Chamoru"},
{"code":"ce","name":"Chechen","nativeName":"нохчийн мотт"},
{"code":"ny","name":"Chichewa; Chewa; Nyanja","nativeName":"chiCheŵa, chinyanja"},
{"code":"zh","name":"Chinese","nativeName":"中文 (Zhōngwén), 汉语, 漢語"},
{"code":"cv","name":"Chuvash","nativeName":"чӑваш чӗлхи"},
{"code":"kw","name":"Cornish","nativeName":"Kernewek"},
{"code":"co","name":"Corsican","nativeName":"corsu, lingua corsa"},
{"code":"cr","name":"Cree","nativeName":"ᓀᐦᐃᔭᐍᐏᐣ"},
{"code":"hr","name":"Croatian","nativeName":"hrvatski"},
{"code":"cs","name":"Czech","nativeName":"česky, čeština"},
{"code":"da","name":"Danish","nativeName":"dansk"},
{"code":"dv","name":"Divehi; Dhivehi; Maldivian;","nativeName":"ދިވެހި"},
{"code":"nl","name":"Dutch","nativeName":"Nederlands, Vlaams"},
{"code":"en","name":"English","nativeName":"English"},
{"code":"eo","name":"Esperanto","nativeName":"Esperanto"},
{"code":"et","name":"Estonian","nativeName":"eesti, eesti keel"},
{"code":"ee","name":"Ewe","nativeName":"Eʋegbe"},
{"code":"fo","name":"Faroese","nativeName":"føroyskt"},
{"code":"fj","name":"Fijian","nativeName":"vosa Vakaviti"},
{"code":"fi","name":"Finnish","nativeName":"suomi, suomen kieli"},
{"code":"fr","name":"French","nativeName":"français, langue française"},
{"code":"ff","name":"Fula; Fulah; Pulaar; Pular","nativeName":"Fulfulde, Pulaar, Pular"},
{"code":"gl","name":"Galician","nativeName":"Galego"},
{"code":"ka","name":"Georgian","nativeName":"ქართული"},
{"code":"de","name":"German","nativeName":"Deutsch"},
{"code":"el","name":"Greek, Modern","nativeName":"Ελληνικά"},
{"code":"gn","name":"Guaraní","nativeName":"Avañeẽ"},
{"code":"gu","name":"Gujarati","nativeName":"ગુજરાતી"},
{"code":"ht","name":"Haitian; Haitian Creole","nativeName":"Kreyòl ayisyen"},
{"code":"ha","name":"Hausa","nativeName":"Hausa, هَوُسَ"},
{"code":"he","name":"Hebrew (modern)","nativeName":"עברית"},
{"code":"hz","name":"Herero","nativeName":"Otjiherero"},
{"code":"hi","name":"Hindi","nativeName":"हिन्दी, हिंदी"},
{"code":"ho","name":"Hiri Motu","nativeName":"Hiri Motu"},
{"code":"hu","name":"Hungarian","nativeName":"Magyar"},
{"code":"ia","name":"Interlingua","nativeName":"Interlingua"},
{"code":"id","name":"Indonesian","nativeName":"Bahasa Indonesia"},
{"code":"ie","name":"Interlingue","nativeName":"Originally called Occidental; then Interlingue after WWII"},
{"code":"ga","name":"Irish","nativeName":"Gaeilge"},
{"code":"ig","name":"Igbo","nativeName":"Asụsụ Igbo"},
{"code":"ik","name":"Inupiaq","nativeName":"Iñupiaq, Iñupiatun"},
{"code":"io","name":"Ido","nativeName":"Ido"},
{"code":"is","name":"Icelandic","nativeName":"Íslenska"},
{"code":"it","name":"Italian","nativeName":"Italiano"},
{"code":"iu","name":"Inuktitut","nativeName":"ᐃᓄᒃᑎᑐᑦ"},
{"code":"ja","name":"Japanese","nativeName":"日本語 (にほんご／にっぽんご)"},
{"code":"jv","name":"Javanese","nativeName":"basa Jawa"},
{"code":"kl","name":"Kalaallisut, Greenlandic","nativeName":"kalaallisut, kalaallit oqaasii"},
{"code":"kn","name":"Kannada","nativeName":"ಕನ್ನಡ"},
{"code":"kr","name":"Kanuri","nativeName":"Kanuri"},
{"code":"ks","name":"Kashmiri","nativeName":"कश्मीरी, كشميري‎"},
{"code":"kk","name":"Kazakh","nativeName":"Қазақ тілі"},
{"code":"km","name":"Khmer","nativeName":"ភាសាខ្មែរ"},
{"code":"ki","name":"Kikuyu, Gikuyu","nativeName":"Gĩkũyũ"},
{"code":"rw","name":"Kinyarwanda","nativeName":"Ikinyarwanda"},
{"code":"ky","name":"Kirghiz, Kyrgyz","nativeName":"кыргыз тили"},
{"code":"kv","name":"Komi","nativeName":"коми кыв"},
{"code":"kg","name":"Kongo","nativeName":"KiKongo"},
{"code":"ko","name":"Korean","nativeName":"한국어 (韓國語), 조선말 (朝鮮語)"},
{"code":"ku","name":"Kurdish","nativeName":"Kurdî, كوردی‎"},
{"code":"kj","name":"Kwanyama, Kuanyama","nativeName":"Kuanyama"},
{"code":"la","name":"Latin","nativeName":"latine, lingua latina"},
{"code":"lb","name":"Luxembourgish, Letzeburgesch","nativeName":"Lëtzebuergesch"},
{"code":"lg","name":"Luganda","nativeName":"Luganda"},
{"code":"li","name":"Limburgish, Limburgan, Limburger","nativeName":"Limburgs"},
{"code":"ln","name":"Lingala","nativeName":"Lingála"},
{"code":"lo","name":"Lao","nativeName":"ພາສາລາວ"},
{"code":"lt","name":"Lithuanian","nativeName":"lietuvių kalba"},
{"code":"lu","name":"Luba-Katanga","nativeName":""},
{"code":"lv","name":"Latvian","nativeName":"latviešu valoda"},
{"code":"gv","name":"Manx","nativeName":"Gaelg, Gailck"},
{"code":"mk","name":"Macedonian","nativeName":"македонски јазик"},
{"code":"mg","name":"Malagasy","nativeName":"Malagasy fiteny"},
{"code":"ms","name":"Malay","nativeName":"bahasa Melayu, بهاس ملايو‎"},
{"code":"ml","name":"Malayalam","nativeName":"മലയാളം"},
{"code":"mt","name":"Maltese","nativeName":"Malti"},
{"code":"mi","name":"Māori","nativeName":"te reo Māori"},
{"code":"mr","name":"Marathi (Marāṭhī)","nativeName":"मराठी"},
{"code":"mh","name":"Marshallese","nativeName":"Kajin M̧ajeļ"},
{"code":"mn","name":"Mongolian","nativeName":"монгол"},
{"code":"na","name":"Nauru","nativeName":"Ekakairũ Naoero"},
{"code":"nv","name":"Navajo, Navaho","nativeName":"Diné bizaad, Dinékʼehǰí"},
{"code":"nb","name":"Norwegian Bokmål","nativeName":"Norsk bokmål"},
{"code":"nd","name":"North Ndebele","nativeName":"isiNdebele"},
{"code":"ne","name":"Nepali","nativeName":"नेपाली"},
{"code":"ng","name":"Ndonga","nativeName":"Owambo"},
{"code":"nn","name":"Norwegian Nynorsk","nativeName":"Norsk nynorsk"},
{"code":"no","name":"Norwegian","nativeName":"Norsk"},
{"code":"ii","name":"Nuosu","nativeName":"ꆈꌠ꒿ Nuosuhxop"},
{"code":"nr","name":"South Ndebele","nativeName":"isiNdebele"},
{"code":"oc","name":"Occitan","nativeName":"Occitan"},
{"code":"oj","name":"Ojibwe, Ojibwa","nativeName":"ᐊᓂᔑᓈᐯᒧᐎᓐ"},
{"code":"cu","name":"Old Church Slavonic, Church Slavic, Church Slavonic, Old Bulgarian, Old Slavonic","nativeName":"ѩзыкъ словѣньскъ"},
{"code":"om","name":"Oromo","nativeName":"Afaan Oromoo"},
{"code":"or","name":"Oriya","nativeName":"ଓଡ଼ିଆ"},
{"code":"os","name":"Ossetian, Ossetic","nativeName":"ирон æвзаг"},
{"code":"pa","name":"Panjabi, Punjabi","nativeName":"ਪੰਜਾਬੀ, پنجابی‎"},
{"code":"pi","name":"Pāli","nativeName":"पाऴि"},
{"code":"fa","name":"Persian","nativeName":"فارسی"},
{"code":"pl","name":"Polish","nativeName":"polski"},
{"code":"ps","name":"Pashto, Pushto","nativeName":"پښتو"},
{"code":"pt","name":"Portuguese","nativeName":"Português"},
{"code":"qu","name":"Quechua","nativeName":"Runa Simi, Kichwa"},
{"code":"rm","name":"Romansh","nativeName":"rumantsch grischun"},
{"code":"rn","name":"Kirundi","nativeName":"kiRundi"},
{"code":"ro","name":"Romanian, Moldavian, Moldovan","nativeName":"română"},
{"code":"ru","name":"Russian","nativeName":"русский язык"},
{"code":"sa","name":"Sanskrit (Saṁskṛta)","nativeName":"संस्कृतम्"},
{"code":"sc","name":"Sardinian","nativeName":"sardu"},
{"code":"sd","name":"Sindhi","nativeName":"सिन्धी, سنڌي، سندھی‎"},
{"code":"se","name":"Northern Sami","nativeName":"Davvisámegiella"},
{"code":"sm","name":"Samoan","nativeName":"gagana faa Samoa"},
{"code":"sg","name":"Sango","nativeName":"yângâ tî sängö"},
{"code":"sr","name":"Serbian","nativeName":"српски језик"},
{"code":"gd","name":"Scottish Gaelic; Gaelic","nativeName":"Gàidhlig"},
{"code":"sn","name":"Shona","nativeName":"chiShona"},
{"code":"si","name":"Sinhala, Sinhalese","nativeName":"සිංහල"},
{"code":"sk","name":"Slovak","nativeName":"slovenčina"},
{"code":"sl","name":"Slovene","nativeName":"slovenščina"},
{"code":"so","name":"Somali","nativeName":"Soomaaliga, af Soomaali"},
{"code":"st","name":"Southern Sotho","nativeName":"Sesotho"},
{"code":"es","name":"Spanish; Castilian","nativeName":"español, castellano"},
{"code":"su","name":"Sundanese","nativeName":"Basa Sunda"},
{"code":"sw","name":"Swahili","nativeName":"Kiswahili"},
{"code":"ss","name":"Swati","nativeName":"SiSwati"},
{"code":"sv","name":"Swedish","nativeName":"svenska"},
{"code":"ta","name":"Tamil","nativeName":"தமிழ்"},
{"code":"te","name":"Telugu","nativeName":"తెలుగు"},
{"code":"tg","name":"Tajik","nativeName":"тоҷикӣ, toğikī, تاجیکی‎"},
{"code":"th","name":"Thai","nativeName":"ไทย"},
{"code":"ti","name":"Tigrinya","nativeName":"ትግርኛ"},
{"code":"bo","name":"Tibetan Standard, Tibetan, Central","nativeName":"བོད་ཡིག"},
{"code":"tk","name":"Turkmen","nativeName":"Türkmen, Түркмен"},
{"code":"tl","name":"Tagalog","nativeName":"Wikang Tagalog, ᜏᜒᜃᜅ᜔ ᜆᜄᜎᜓᜄ᜔"},
{"code":"tn","name":"Tswana","nativeName":"Setswana"},
{"code":"to","name":"Tonga (Tonga Islands)","nativeName":"faka Tonga"},
{"code":"tr","name":"Turkish","nativeName":"Türkçe"},
{"code":"ts","name":"Tsonga","nativeName":"Xitsonga"},
{"code":"tt","name":"Tatar","nativeName":"татарча, tatarça, تاتارچا‎"},
{"code":"tw","name":"Twi","nativeName":"Twi"},
{"code":"ty","name":"Tahitian","nativeName":"Reo Tahiti"},
{"code":"ug","name":"Uighur, Uyghur","nativeName":"Uyƣurqə, ئۇيغۇرچە‎"},
{"code":"uk","name":"Ukrainian","nativeName":"українська"},
{"code":"ur","name":"Urdu","nativeName":"اردو"},
{"code":"uz","name":"Uzbek","nativeName":"zbek, Ўзбек, أۇزبېك‎"},
{"code":"ve","name":"Venda","nativeName":"Tshivenḓa"},
{"code":"vi","name":"Vietnamese","nativeName":"Tiếng Việt"},
{"code":"vo","name":"Volapük","nativeName":"Volapük"},
{"code":"wa","name":"Walloon","nativeName":"Walon"},
{"code":"cy","name":"Welsh","nativeName":"Cymraeg"},
{"code":"wo","name":"Wolof","nativeName":"Wollof"},
{"code":"fy","name":"Western Frisian","nativeName":"Frysk"},
{"code":"xh","name":"Xhosa","nativeName":"isiXhosa"},
{"code":"yi","name":"Yiddish","nativeName":"ייִדיש"},
{"code":"yo","name":"Yoruba","nativeName":"Yorùbá"},
{"code":"za","name":"Zhuang, Chuang","nativeName":"Saɯ cueŋƅ, Saw cuengh"}
];


$(document).ready(function(){
    $('select#language-select').each(function(i, obj){
        $.each(lang, function(key, value) {   
            $(obj)
            .append($('<option>', { value : value['name'] })
                .text(value['name']));
        });
    });

    $('.language-select').each(function(){
        var l = $(this).parent().find('.get_languages').val();
        $(this).find('option[value="'+l+'"]').attr('selected', true);
    });
});

$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".language-body"); //Fields wrapper
    var add_button      = $(".add-lang"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append("<tr><td><select name='language[]' id='language-select' class='language-select form-control'></select></td><td><select name='lang_proficiency[]' class='form-control'><option value='basic'>Basic</option><option value='moderate'>Moderate</option><option value='high'>High</option></select></td><td><input type='button' class='pull-right delete-lang btn theme-btn-dk' value='-'/></td></tr>"); //add input box
            $('select#language-select').each(function(i, obj){
                $.each(lang, function(key, value) {
                    $(obj)
                    .append($('<option>', { value : value['name'] })
                        .text(value['name']));
                });
            });
        }
    });
    
    $(wrapper).on("click",".delete-lang", function(e){ //user click on remove text
        e.preventDefault();     $(this).parent().parent().remove(); x--;
    });
});
});



$(document).on('change', '#id_day, #id_year, #id_month', function(){
    var month = $('#id_month').val();
    var day = $('#id_day').val();
    var year = $('#id_year').val();

    var birthday = new Date(month+'/'+day+'/'+year);

    var today = new Date();
    var age = today.getFullYear() - birthday.getFullYear();
    var m = today.getMonth() - birthday.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthday.getDate())) {
        age--;
    }

    new_year_format = year.substr(2,4);
    $('#id_number_non_is_resident').val(day+month+new_year_format);
    if($('input[type="radio"][name="has_id"]').val() == 1){
        $('#is_resident_id_number').val(day+month+new_year_format);
    } else {
        $('#id_number_non_is_resident').val(day+month+new_year_format);
    }

    $('#age').val(age);
    $('#birthday').val(month+'/'+day+'/'+year);
});