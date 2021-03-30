<?php   
    require_once "db.php";

    $usr_fname = ""; $usr_lname = ""; $usr_email = ""; $usr_phone = "";
    if(isset($_SESSION['logged']) && $_SESSION['logged'] === true){
        $sel_user_data = prep_stmt("SELECT * FROM users WHERE user_id=?", user_id(), "i");
        if(mysqli_num_rows($sel_user_data) > 0){
            while($row = mysqli_fetch_array($sel_user_data)){
                $usr_fname= $row['first_name'];
                $usr_lname = $row['last_name'];
                $usr_email = $row['email'];
                $usr_phone = $row['tel_nr'];
            }
        }
    }
?>
<?php require "header.php"; ?>
<main class="bg_gray">
    <div class="container margin_60">
        <div class="main_title">
            <h2>Politikat e Privatësisë të DealAim</h2>
            </p>
        </div>
    </div>  
    <div class="bg_white">
        <div class="container margin_60_35" style="font-family: Futura W01 Book;">
            <div class="col-md-12 text-center"> 
                <div style="width:60%; margin: 0 auto; height: auto;">   

                </div>
            </div>
            <div class="col-md-10" style="margin: 0 auto; ">    
                <h5> Detyrimet tona Rreth Privatësisë</h5>
                <p> DealAim është e përkushtuar në ruajtjen e plotë të privatësis së përdoruesve që janë pjesë e DealAim Company. Kjo faqe e "Politikave të Privatësisë" se si DealAim i mledh, përdorë, dhe shpërndan të dhënat tuaja personale në lidhje me përdorimin e ueb aplikacionit tonë dhe shërbimeve që i ofron ky ueb aplikacion, dhe shpjegon zgjedhjet tuaja mbi atë se si ne trajtojmë të dhënat tuaja personale. </p>
                <p>Duke krijuar një llogari, ju pranoni të jeni të kufizuar dhe detyruar nga termet dhe kushtet e kësaj Politike të Privatësisë. Nëse nuk pajtoheni me termet dhe kushtet që i ofron kjo Politikë, ju lutemi mos e përdorni ose mos u qasni në sistemin tonë online. Duke pranuar Politikën e Privatësisë, ju qartësisht pranoni të drejtën tonë për përdorimin dhe demaskimin e të dhënave tuaja personale në përputhje me Politikën. Politika e Privatësisë është e inkorporuar dhe u nënshtrohet kushteve të çdo marrëveshjeje që nënshkruani me DealAim dhe bëhet e zbatueshme pasi të marrim miratimin tuaj si një përdorues i regjistruar. Nëse keni ndonjë pyetje shtesë rreth Politikave tona të Privatësis, ju lutemi na kontaktoni në <a href="mailto:info@dealaim.com">info@dealaim.com</a></p>
                <p>Për qëllimet e kësaj Politike të Privatësisë, termi "të dhëna personale" nënkupton çdo informacion që ju identifikon ose që ju lejon të identifikoheni kur kombinohen me informacione të tjera.</p>
            </div> <br/>
            <div class="col-md-10" style="margin: 0 auto; ">    
                <h5>Të Dhënat Personale që ne Mbledhim</h5>
                <p>Nëse ti zgjedh të përdorësh shërbimet tona, me mund të ju kërkojmë mbledhjen, përdorimin, ruajtjen dhe transferimin e kategorive të caktuara të të dhënave.</p>
                <p>Kur është e mundur, ne ju tregojmë fushat që duhet patjetër të mbushen dhe ato të cilat janë opsionale. Ju nuk jeni i detyruar të jepni të dhënat nëse vendosni të mos përdorni një shërbim ose funksion të veçantë.</p>
            </div>
            <div class="col-md-10" style="margin: 0 auto; ">    
                <h5>Të Dhënat që na Jepni</h5>
                <p>Kur ju përdorni sistemin tonë, ju mund të na jepni të dhënat tuaja personale përmes bashkëveprimit të drejtëpërdrejtë, siç është mbushja e formularëve:</p>
                <ol style="list-style-type:disc;">
                    <li><b>Të dhënat e llogarisë</b> - përfshinë përdoruesin (username), fjalëkalimin, emrin, mbiemrin,email-in, numrin e telefonit,  datëlindjen, qytetin, kodin postar, adresën e plotë, ID identifikuese.</li>
                    <li><b>Të dhënat e profilit</b> - e cila pfshinë të gjitha ato më lartë dhe një foto të profilit (jo e detyrueshme).</li>
                    <li><b>Të dhënat financiare</b> - e cila përfshinë të dhënat e kartes së kreditit (MasterCard apo VISA). Megjithëse ato shfaqen vetëm me iniciale dhe askush nuk mund ti shoh ato, madje as ju.</li>
                </ol>
            </div>
            <div class="col-md-10" style="margin: 0 auto; ">    
                <h5>Si i Përdorim Ne Të Dhënat Tuaja Personale</h5>
                <p>Ne mund të përdorim të dhënat tuaja personale për qëllimet vijuese: </p>
                <ol style="list-style-type:disc;">
                    <li>Për të përmbushur kontratat me ju dhe për të lehtësuar shërbimet që ju personalisht kërkoni.</li>
                    <li>Për të ju siguruar mbëshetetjen e përdoruesit përmes kanaleve të ndryshme ,  përfshirë përmes email adresës apo numrit të telefonit.</li>
                    <li>Për të përmirësuar përmbajtjen, paraqitjen dhe ofertat e produkteve tuaja.</li>
                    <li>Për të ju faturuar dhe për të marr paratë që ju na detyroheni neve.</li>
                    <li>Për të verifikuar dhe vërtetuar identitetin tuaj, dhe për të zbuluar dhe parandaluar mashtrimet</li>
                    <li>Për të zbuluar dhe për tu mbrojtur nga gabimet, mashtrimet dhe aktivitetet tjera kriminale.</li>
                    <li>Për të zbatuar pajtueshmërinë me <a href="terms_and_conditions.php" style="color:#0097ba">Termet dhe Kushtet tona të përdorimit </a> dhe kontratëN e zbatueshme, dhe për të mbrojtur të drejtat dhe sigurinë e anëtarëve tanë dhe palëve të treta, si dhe tonat.</li>
                    <li>Të pajtohemi me detyrimet tona ligjore, duke përfshirë mbajtjen e regjistrave, dhe të jemi në përputhje me çdo detyrë në kontekstin e hetimeve penale ose hetimeve të tjera nga autoritetet kompetente.</li>
                </ol>
            </div>
            <div class="col-md-10" style="margin: 0 auto; ">    
                <h5>Kur Shpërndahen Të Dhënat Tuaja Personale</h5>
                <p>Në fakt qasje në të dhënat tuaja kanë vetëm administratorët, por gjatë vendosjes së ofertave për produktet përkatëse përdoruesit tjerë mund të shohin vetëm inicialin e parë të emrit të përdoruesit dhe të fundit, pjesa tjetër është e fshehur.</p>
            </div>
            <div class="col-md-10" style="margin: 0 auto; ">    
                <h5>Kontakti</h5>
                <p>Nëse keni ndonjë pyetje ose ankesë në lidhje me këto Politika të Privatësisë, ose nëse dëshironi të kyçeni, korrigjoni, ndryshoni ose fshini ndonjë të dhënë personale, mund të na kontaktoni në info@dealaim.com ose me postë në:</p>
               <p> DealAim</br>
                76, AFËRDITA, Madeleine Allbright</br>
                Gjilan,<br/>
                KOSOVË.</p>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
</main>
<?php require "footer.php"; ?>