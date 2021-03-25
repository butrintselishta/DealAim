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
            <h2 >Termet dhe Kushtet e përdorimit</h2>
            <p style="font-size:0.875rem;">Në rast pyetjesh në lidhje me termet dhe kushtet tona të përgjithshme, departamenti ynë i shërbimit ndaj klientit do të jetë i lumtur t'ju ndihmojë. Ju lutem kontaktoni: <br/>
                <b>DealAim - departamenti i shërbimeve ndaj klientëve </b><br/>
                    Tel.: +383 (44) 991 - 411<br/>
                    E-Mail:info@dealaim.com <br/>
                    Ose duke na shkruar mesazh <a href="contact.php">këtu </a>
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
                <h4> Hyrje</h4>
                <p> Mirë se vini në DealAim. Ky dokument dhe të tjerat të cilat janë të përshkruara më poshtë përcaktojnë <b style="color:#172134">Termet dhe Kushtet e përdorimit</b> të cilat duhet zbatuar në rast se dëshironi të përdorni shërbimet e ankandit të hapur që ne i ofrojmë, si dhe pjesmarrjen tuaj të drejtpërdrejt në ankandet e hapur, pa marrë parasysh llojin e produktit, për të gjitha janë njësoj. </p>
                <p>Duke përdorur secilën nga shërbimet që i ofron çdonjëra nga faqet e DealAim (p.sh myauctions.php ose çfardo faqe tjetër ku Termet dhe Kushtet shfaqen), ju jeni duke u dakorduar për termet dhe kushtet e mëposhtme.</p>
                <p>Para se të bëheni një antar i DelAim, është e rruges që ju t'i lexoni dhe t'i pranoni Termet dhe <b style="color:#172134"><a href="privacy.php" style="color:#0097ba">Polikat tona të Privatësisë</a></b>  , por e domosdoshme është vetëm në rastin kur ju dëshironi të merrni të drejtat(statusin) e shitësit. Ne fuqishë ju rekomandojmë që, përderirsa ju lexoni Termet dhe Kushtet, të keni qasje dhe të lexoni edhe informatat tjera si Politikat e Privatësisë. </p>  
                <p>Ju e kuptoni dhe pranoni se ne mund t'i nderrojmë termet dhe kushtet e përdorimit në çfarëdo kohe, dhe nga koha ne kohë, duke i vendosur kushtet e ndërruara në këtë faqe. Të gjitha kushtet e perdorimit jane automatikisht të vlefshme në të ardhmen pasi të jenë postuar në webfaqen tonë. Në perputhje me të, ju jeni te inkurajuar qe periodikisht t'i rishikoni kushtet e perdorimit per ndryshime të mundshme. </p>
            </div> <br/>
            <div class="col-md-10" style="margin: 0 auto; ">    
                <h4> Termet dhe Kushtet e përdorimit për ankandin e hapur</h4>
                <ol>
                    <li><b> Pranueshmëria. </b> Çdo ankand i hapur për një produkt përkatës përmban kërkesat e tij/saj që ju duhet t'i përmbushni për tu bërë pjesë e tij. Ju mund të merrni pjesë në çdo ankand të hapur në këtë ueb aplikacion përderisa i përmbushni kushtet e secilit prej tyre. Kjo nuk do të thot se mund të jeni fitues i secilit prej tyre. Ai që jep ofertën e fundit e fiton atë.</li>
                    <li><b> Pagesat dhe Tarifat. </b> 
                        <ol style="list-style-type: lower-alpha;">
                            <li><b> Tarifat e Ankandit të Hapur. </b> Ju pranoni që të jeni të detyruar të paguani të gjitha tarifat të cekura nga Termet dhe Kushtet e përdorimit. Ju pranoni që për çdo produkt të cilin arrini ta shisni përmes ankandit të hapur të paguani <b>5.5%</b> të çmimit nga shitja e tij, kjo pagesë bëhet automatikisht me rastin e mbylljes së ankandit. Gjithashtu ju pranoni të paguani <b>1.2%</b> nga tërheqja e parave nga llogaria juaj. Çdo herë që kryeni një shërbim të tillë nga shuma e tërhequr automatikisht ju merren 1.2% e shumës.Ju jeni të vetëdijsh dhe pranon që këto tarifa mund të ndryshojnë me kohë.  </li>
                            <li><b> Procesi i pagesave në ofertim dhe blerje. </b> Të gjitha produktet aktive në ankand të hapur përbëjnë një çmim fillestar. Me ofertimin në produktin përkatës ju pranoni që paratë tuaja me të cilat keni ofertuar do të jenë të bllokuara në sistemin tonë deri në momentin e mbylljes së ankandit. Në rast se ju jeni fitues i ankandit ju pranoni që ato para të i shkojnë në llogarinë e shitësit. Ndërsa në rast se dikush tjetër fiton ankandin parat tuaja do të i'u kthehen në llogari. </li>
                        </ol>
                    </li>
                    <li><b> DealAim është vetëm 'vendi i ngjarjes'. </b>
                        <ol style="list-style-type: lower-alpha;">
                            <li><b>Shërbimet.</b>
                            Ne nuk jemi 'shtëpija e ankandeve' dhe ne nuk jemi udhheqës të ankandeve. Shërbimet tona ju lejojnë juve të merrni pjesë në ankande të produkteve të vendosura nga përdoruesit tjerë, gjithashtu ju lejojnë të vendosni produktet tuaja dhe të jeni udhëheqës i ankandit përkatës. Ne jemi vetëm ai kanali përmes të cilës ju mundësohet të kryeni veprimet përmes shërbimeve tona. Por ne rezevojmë të drejten për vendosjen ose jo të produkteve tuaja në ankand. Gjithashtu rezervojmë të drejtën për dnryshim të disa apo të gjitha shërbimeve në çdo kohë. 
                            </li>
                        </ol>
                        <ol style="list-style-type: lower-alpha;">
                            <li><b>Kontrolli.</b>
                            </li>
                            Ne nuk kemi kontroll në kualitetin, sigurinë ose legalitetin e produkteve në ankand, të vërtetën ose saktësin e listimeve të produkteve, apo aftësin e shitësve për shitje dhe aftësin e blerësve për blerje.
                        </ol>
                        <ol style="list-style-type: lower-alpha;">
                            <li><b>Pajtueshmëria me ligjin.</b>
                            </li>
                            Ju e kuptoni dhe pranoni që përdorimi, blerja. promovimi dhe shitja e produkteve të caktuara përmes ankandit të hapur i nënshtrohet rregulloreve të shtetit të Kosovës dhe rregulloreve lokale. Ju më tutje kuptoni dhe pranoni se roli i DealAim në lidhje me shitjen e produkteve është i limituar në sigurimin e një kanali përmes të cilit një blerës i mundshëm i ardhshëm mund të marr pjesë në një ankand. DealAim merr përsipër rishikimin e të dhënave për produktin që do vendoset në ankand, dhe në rast se përmban përshkrim jo në lidhje me produktin, ne rezevojmë të drejten e mos pranimit të produktit. Por gjithsesi ju qartësisht pranoni se duhet të jeni në përputhje me të gjitha ligjet, statutet, urdhëresat dhe rregulloret e zbatueshme shtetërore dhe lokale, në lidhje me përdorimin, blerjen dhe shpërndarjen e çdo produkti për të cilin bëni ofertë ose blini përmes DealAim. Ju në çdo kohë do të mbroni, dëmshpërbleni dhe mbështetni DealAim, edhe përdoruesit, partnerët, aksionarët, drejtorët, puntorët e agjentët e tyre, në rast se produkti që ju shitni nuk i'u përmbahet të dhënave të shkruara dhe të paraqitura në faqen e ankandit përkatës për produktin përkatës.
                        </ol>
                    </li>
                    <li><b> Ankandet aktive. </b> Faqja e produkteve do të listoj të gjitha produktet e disponueshme ku ju mund të ofertoni. Koha,e shfaqur me ditë, orë, minutë e sekond se kur ankandi përkatës do të mbyllet është e përcaktuar nga shitësi dhe nuk mund të ndryshohen në asnjë rast kur prodkuti lejohet të vendoset në ankand. Ne mund të kontrolljmë të dhënat për produktin përkatës përpara se ta pranojmë atë por nuk mund të garantojmë që shitësi ka vendosur produktin me të dhëna të sakta ose që produkti është vendosur në përputhje me të gjitha ligjet, rregullat dhe rregulloret në fuqi. 
                    </li>
                    <li><b> Ofertimi, Blerja dhe Kushtet e shitjes. </b> 
                    Termet dhe Kushtet për pjesmarrjen në secilin ankand, duke përfshirë se si ofertat pranohen, si ofertat rriten, kushtet që blerësi duhet të plotësoj që të blejë broduktin, si dhe kushtet specifike të shitjes (siç janë garancitë, pagesat e tarifës për shitje të produktit, sigurimin dhe të ngjashme) mund të jenë të ndryshme për secilin ankand varësisht nga çmimi. Shitësi i produktit është i/e detyruar të postojë termet e kushtet e veta dhe të qëndroj pas tyre deri në mbyllje të ankandit.Ju pranoni t'i detyroheni atyre kushteve e term-eve të ofertimit për sitje dukke rënë dakord me Kushtet dhe Termet. Termet, përveç atyre kushteve dhe term-eve të ankandit përkatës, rregullojnë aktivitetin tuaj të ofertimit, si dhe pjesmarrjen tuaj në secilin ankand. Ankandi përkatës përfundon në një kohë të caktuar dhe ofertuesi i fundit është fitues i tij, nuk ka mundësi për ndryshime nga ana shitësit apo edhe kompanisë kur produkti është në ankand.
                    </li>
                    <li><b> Përdorimi i fotografive. </b> 
                    DealAim rezervon të drejtën për përdorim, në ueb aplikacionin e tyre dhe në reklamimin e matreiale promovuese, fotografitë e produkteve që shiten ose që janë shitur në ueb aplikacionin e tyre, përfshirë fotografitë që janë blerë në këtë ueb aplikacion.
                    </li>
                    <li><b> Perdorimi i DealAim. </b> 
                    Derisa përdorni DealAim, ju nuk duhet të:
                        <ol style="list-style-type: lower-alpha;">
                            <li> Shkelni ligjet, rregullat, rregulloret ose të drejtat e palëve të treta</li>
                            <li>përdorni faqet ose shërbimet nëse nuk jeni në gjendje të formoni kontrata të detyrueshme ligjërisht, jeni nën moshën 18 vjeç ose jeni të pezulluar përgjithmonë ose për një kohë të caktuar nga ueb aplikacioni ynë</li>
                            <li>Manipuloni me çmimet e produkteve ose të ndërhyni në listat apo produktet e përdoruesve tjerë.</li>
                            <li>Postoni përmbajtje të rreme, të pasakt, mashtruese ose shpifëse (përfshirë edhe të dhënat personale).</li>
                            <li>Të shpërndani ose postoni të dhëna të pa dëshirueshme apo 'skema piramidale'.</li>
                            <li>Shpërndani viruse ose ndonjë teknologji tjetër që mund të dëmtojë DealAim, faqet tona, ose interesat apo pronën e përdoruesve të DealAim.</li>
                            <li>Kopjoni, modifikoni ose shpërndani përmbajtje nga faqet tona dhe/ose shkelni të drejtat e autorit ose markat tregtare të DealAim</li>
                            <li>Korrje ose mbledhje të informacionit në lidhje me përdoruesit, duke përfshirë, pa kufizim, email adresat, pa pëlqimin e tyre. As nuk do të inkurajoni apo ndihmoni një palë të tretë të bëhet pjesë e ndonjë prej sjelljeve jo të lejuara të cekura më lartë. Çdo shkelje e këtyre depozitave do të përbëj shkelje të Termeve dhe Kushteve të përdorimit, dhe në rrethana të tilla ne do të kemi të drejtë, sipas diskrecionit tonë të vetëm dhe absolut, të u'a ndalojmë çasjen e juaj në faqet tona dhe të pezullojmë të drejtën tuaj për të përdorur shërbimet tona.</li>
                        </ol>
                    </li>
                    <li><b> Abuzimi i DealAim. </b> 
                        <ol style="list-style-type: lower-alpha;">
                            <li>DealAim do të punojmë vazhdimisht për të mbajtur faqet dhe shërbimet tona për të qenë në dispozicion 24 orë dhe pa pengesa. Ju lutemi raportoni problemet, përmbajtjet ofenduese, dhe çdo shkelje të politikave të privatësis tek ne!</li>
                            <li>Pa kufizuar mjetet tona juridike, kuptohet që ne mund të kufizojmë, pezullojmë ose përfundojmë shërbimet tona dhe llogaritë e përdoruesve, të ndalojmë hyrjen në faqet tona, të vonojmë ose heqim përmbajtjen e pritur dhe të marrim hapa teknikë dhe ligjorë për t'i mbajtur përdoruesit jashtë faqeve tona nëse besojmë se ata po keqpërdorin, abuzojnë ose ndërhyjnë në ofrimin e shërbimeve tona, përfshihen në sjellje të paligjshme, ose veprojnë në kundërshtim me shkronjën ose frymën e politikave tona. Ne gjithashtu rezervojmë të drejtën për të anuluar llogari të pakonfirmuara ose llogari që kanë qenë joaktive për një kohë të gjatë.</li>
                        </ol>
                    </li>
                </ol>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
</main>
<?php require "footer.php"; ?>