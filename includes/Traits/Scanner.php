<?php

namespace Chatty\Traits;

use GuzzleHttp\Client;

trait Scanner
{
    public $BOT_PREFIX = '/ct|chatty';

    public function scanCommands()
    {
        if ($this->text == 'salut') {
            $this->respond('https://az705183.vo.msecnd.net/onlinesupportmedia/onlinesupport/media/skype/screenshots/fa12330/emoticons/hi_80_anim_gif.gif', false);
        }

        elseif ($this->text == 'ce cald e') {
            $this->respond('https://az705183.vo.msecnd.net/onlinesupportmedia/onlinesupport/media/skype/screenshots/fa12330/emoticons/sweating_80_anim_gif.gif', false);
        }

        elseif ($this->text == 'byte-ul') {
            $this->respond('https://az705183.vo.msecnd.net/onlinesupportmedia/onlinesupport/media/skype/screenshots/fa12330/emoticons/sloth_40_anim_gif.gif', false);
        }

        elseif (strtolower($this->text) == 'whois') {
            $this->respond('https://az705183.vo.msecnd.net/onlinesupportmedia/onlinesupport/media/skype/screenshots/fa12330/emoticons/sadsmile_80_anim_gif.gif', false);
        }

        elseif ($this->text == 'chatty') {
            $this->respond('https://az705183.vo.msecnd.net/onlinesupportmedia/onlinesupport/media/skype/screenshots/fa12330/emoticons/lalala_80_anim_gif.gif', false);
        }

        elseif ($this->text == 'carding') {
            $this->respond('https://az705183.vo.msecnd.net/onlinesupportmedia/onlinesupport/media/skype/screenshots/fa12330/emoticons/bandit_80_anim_gif.gif', false);
        }

        elseif ($this->text == 'brb') {
            $this->respond('https://az705183.vo.msecnd.net/onlinesupportmedia/onlinesupport/media/skype/screenshots/fa12330/emoticons/brb_80_anim_gif.gif', false);
        }

        elseif (preg_match('/muie|pizda|futu-?ti|fmm|stf|sugi|pula|cur/i', $this->text)) {
            $this->respond('https://az705183.vo.msecnd.net/onlinesupportmedia/onlinesupport/media/skype/screenshots/fa12330/emoticons/whistle_anim.gif', false);
        }

        elseif (preg_match('/\b(bere|beer)\b/i', $this->text)) {
            $this->respond('https://az705183.vo.msecnd.net/onlinesupportmedia/onlinesupport/media/skype/screenshots/fa12330/emoticons/beer_80_anim_gif.gif', false);
        }

        elseif (preg_match('/\b(bicicleta|fallen)\b/i', $this->text)) {
            $this->respond('https://az705183.vo.msecnd.net/onlinesupportmedia/onlinesupport/media/skype/screenshots/fa12330/emoticons/bike_80_anim_gif.gif', false);
        }

        elseif (preg_match('/\b(fotbal|seminte)\b/i', $this->text)) {
            $this->respond('https://az705183.vo.msecnd.net/onlinesupportmedia/onlinesupport/media/skype/screenshots/fa12330/emoticons/dull_80_anim_gif.gif', false);
        }

        elseif (preg_match('/\b(aa7670)\b/i', $this->text)) {
            $this->respond('https://az705183.vo.msecnd.net/onlinesupportmedia/onlinesupport/media/skype/screenshots/fa12330/emoticons/poolparty_80_anim_gif.gif', false);
        }

        elseif (preg_match('/\b(zatarra)\b/i', $this->text)) {
            $this->respond('https://az705183.vo.msecnd.net/onlinesupportmedia/onlinesupport/media/skype/screenshots/fa12330/emoticons/bandit_80_anim_gif.gif', false);
        }

        elseif (preg_match('/\b(worm|digitalc)\b/i', $this->text)) {
            $this->respond('https://www.facebook.com/images/emoji.php/v5/zfe/1/32/1f4a9.png', false);
        }

        elseif ($this->text == 'clear chat') {
            $this->respond("\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");
        }

        elseif ($this->text == 'date') {
            $this->respond(date('Y/m/d - H:i:s'));
        }

        elseif ($this->text == 'data') {
            $this->respond(date('d.m.Y - H:i:s'));
        }

    }

    public function scanRandom()
    {
        if ($this->isPrefixed('(?:scan|\./scan\.pl)')) {
            $command = $this->getCommand('(?:scan|\./scan\.pl)');

            switch (true) {
                case preg_match('/curve|pizde|whores?/i', $command):
                    $this->respondWithWhores();
                    break;

                case preg_match('/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/i', $command):
                    $this->respondWithIP($command);
                    break;

                case preg_match('/user[is]?/i', $command):
                    $this->respondWithUsers();
                    break;
            }
        }

        elseif ($this->isPrefixed('joke')) {
            $this->respondWithJoke();
        }

        elseif ($this->isPrefixed('comp')) {
            $this->respondWithComputation($this->getCommand('comp'));
        }

        elseif ($this->isPrefixed('(?:conv|convert)')) {
            $this->respondWithConversion($this->getCommand('(?:conv|convert)'));
        }

        elseif ($this->isPrefixed('(?:weather|vremea)')) {
            $this->respondWithWeather($this->getCommand('(?:weather|vremea)'));
        }

        elseif ($this->isPrefixed('(?:yt|youtube) rand(?:om)?')) {
            $this->respondWithRandomYoutubeLink();
        }

        elseif ($this->isPrefixed('giphy')) {
            $this->respondWithGiphyResult($this->getCommand('giphy'));
        }
    }

    public function AI($message, $resultNumber = null)
    {
        if (preg_match('#' . str_replace('#', '\#', $message) . '#i', $this->getCommand('chatty'), $result)) {
            return is_null($resultNumber) ? true : $result[$resultNumber];
        }

        return false;
    }

    public function scanAI()
    {
        if (! $this->isPrefixed('chatty,?')) {
            return;
        }

        $money_file = __DIR__ . '/../../tmp/money.txt';

        if ($this->text == '') {
            $this->respond('Esti timid?');
        }

        if ($this->AI('iesi$')) {
            if ($this->isAdmin()) {
                $this->respond('Gata boss. Am iesit.');
                die;
            } else {
                $this->respond('Nice try, fag');
            }
        }

        if ($this->AI('.*') && rand(0, 30) == 4) {
            $res = ['http://fbcdn-sphotos-e-a.hubatka.cz/hphotos-ak-prn1/44530_491807354174208_665546187_n.jpg?v324mn23f8v8s4n2nm3fs892mn2m34n289f7s98djk4n52k3j4h28w9f7smn2m3n42k3pf7sd9fwm', 'Mai lasa-ma c-am treaba.'];

            $this->respond($res[rand(0, count($res) - 1)]);
        }

        if ($this->AI('esti trist\?')) {
            $this->respond('Da, dar nu mai trist ca wHoIS. :(');
        }

        if ($this->AI('.*?ce(?:-| )ai facut bai? baiatule')) {
            $this->respond('Am dat un raspuns corespunzator.');
        }

        if ($this->AI('de ce ?\?')) {
            $this->respond('Pentru ca: muie');
        }

        if ($this->AI('.*?prost.*?chat')) {
            $users = $this->getUserList();
            $this->respond($users[rand(0, count($users) - 1)] . '.');
        }

        if ($amount = $this->AI('(poftim|ia) ([0-9]+)', 2)) {
            if ($amount > 100) {
                $this->respond('Esti prea darnic, nu vreau sa te las fara bani. Te refuz.');
            }

            if (rand(0, 100) == 34) {
                $this->respond('M-am hotarat sa donez toti cei ' . ((int) file_get_contents($money_file)) . ' bistari studentilor.');
                file_put_contents($money_file, 0);
            }

            file_put_contents($money_file, ((int) file_get_contents($money_file)) + ((int) $amount));
            $res = ['Sa fie primit', 'Bogda proste', 'Merci', 'Multumesc', 'Sa traiesti', 'Nu mor eu luna asta', 'Mhm', 'Merci, am plecat la curve', 'Multi bani'];

            $this->respond($res[rand(0, count($res) - 1)] . '.');
        }

        if (($amount = $this->AI('(ascunde|renunta|cheltuie) ([0-9]+)', 2)) && $this->isAdmin()) {

            $new_amount = ((int) file_get_contents($money_file)) - ((int) $amount);
            $new_amount = $new_amount < 0 ? 0 : $new_amount;

            file_put_contents($money_file, $new_amount);
            $res = ['Cam asa se duc ' . $amount . ' pe pula', 'Arunc cu banii in dusmani', 'Dau euro pe lire', 'Noi sa fim sanatosi', 'O yea'];

            $this->respond($res[rand(0, count($res) - 1)] . '.');
        }

        if ($this->AI('cat[ie] (bani|bistari|coco|e[ou]ro|dolari|usd|\$|lire) ai')) {
            $res = ['bistari', 'coco', 'eoro', 'dineros', 'lire straine'];

            $this->respond('Am ' . ((int) file_get_contents($money_file)) . ' ' . $res[rand(0, count($res) - 1)] . '.');
        }

        if ($this->AI('ce (muzica|melodii)? ?asculti')) {
            $res = ['Professor P', 'Blahz Martell', 'Vinnie Paz', 'rap', 'hip-hop', 'Eduard Khil', 'Rick Astley', 'Serafim', 'Chimie', 'Flou Rege', 'Vlad Dobrescu', 'Ill Bill', 'Eminem'];

            $this->respond('Ascult ' . $res[rand(0, count($res) - 1)] . '.');
        }

        if ($this->AI('ce faci')) {
            $this->respond('Fac ce vreau.');
        }

        if ($this->AI('aferent')) {
            $this->respond('Corespunzator.');
        }

        if ($this->AI('corespunzator')) {
            $this->respond('Aferent.');
        }

        if ($this->AI('d[aă]-?mi')) {
            $this->respond('Deschide gura.');
        }

        if ($this->AI('.*?chatty')) {
            $this->respond('Chatty iti spune sa te caci in palma.');
        }

        if ($this->AI('cine-i cel .*? bot')) {
            $this->respond('Toti cei care au raspuns la aceasta intrebare.');
        }

        if ($this->AI('cine esti')) {
            $this->respond('Daca ma mai intrebi odata iti postez CNP-ul pe site-ul politiei locale.');
        }

        if ($this->AI('cine-i boss')) {
            $this->respond('Gecko e boss-ul.');
        }

        if ($this->AI('cat e ceasu')) {
            $this->respond('Scrie "date".');
        }

        if ($this->AI('ia.*?pula')) {
            $this->respond('Hahaha. Ai pus mana pe ea.');
        }

        if ($this->AI('stii programare')) {
            $this->respond('Da, m-am auto-programat.');
        }

        if ($this->AI('stii')) {
            $this->respond('Nu.');
        }

        if ($this->AI('mer[sc]i|multumesc')) {
            $this->respond('Hai ca esti bagabont.');
        }

        if ($this->AI('ai gagica')) {
            $this->respond('Da, a fost nevoie de doi ca sa te nasti.');
        }

        if ($this->AI('.*?manele')) {
            $this->respond('Nu ma intereseaza despre ce vorbesti, esti inutil.');
        }

        if ($this->AI('cati ani ai')) {
            $this->respond('4294967295.');
        }

        if ($this->AI('zi ceva de')) {
            $this->respond('Da ce-s eu? sclavul tau?');
        }

        if ($this->AI('zi.*?gluma')) {
            $this->respondWithJoke();
        }

        if ($this->AI('cere(-ti)? scuze')) {
            $this->respond('Ma faci sa rad, aratare organica.');
        }

        if ($this->AI('scuze')) {
            $this->respond('Ok. Imediat iti sterg datele postate pe matrimoniale.');
        }

        if ($this->AI('salut')) {
            $res = ['One love, man', 'Sunt prea popular ca sa vorbesc cu cei ca tine', 'Ciao, bella', 'Salut', 'Peace', 'Keep it real'];

            $this->respond($res[rand(0, count($res) - 1)] . '.');
        }

        if ($this->AI('esti prost.*?\?')) {
            $this->respond('Nu.');
        }

        if ($this->AI('te iubesc')) {
            $this->respond('No homo. Si eu.');
        }

        if ($this->AI('te lovesc')) {
            $this->respond('Au. Glumeam. Te-am notat pe caiet sa-ti dau muie.');
        }

        if ($this->AI('(esti|puti|mirosi|sugi|esti ratat)$')) {
            if ($this->isAdmin()) {
                $this->respond('Da.');
            }
            else {
                $this->respond('Ba tu.');
            }
        }

        if ($this->AI('.*?ban lu')) {
            $res = ['Da', 'Nu'];

            $this->respond($res[rand(0, count($res) - 1)] . '.');
        }

        if ($this->AI('cine.*?(gabor|militian|politist|politie|diicot|police|militie|cocalar|poponar|gay)')) {
            $users = $this->getUserList();
            $this->respond($users[rand(0, count($users) - 1)] . '.');
        }

        if ($this->AI('da cu zar')) {
            if ($this->isAdmin()) {
                $this->respond('6.');
            }

            $this->respond(rand(1, 6) . '.');
        }

        if ($this->AI('taci')) {
            $this->respond('Nu.');
        }

        if ($this->AI('(fa )?update')) {
            $this->respond('Tzj, tzj, beep, boop. Glumeam. Cine dracu te crezi?');
        }

        if ($this->AI('unde')) {
            $res = ['Sub poduri', 'In canal', 'Pe centura', 'In penthouse', 'La palat', 'Unde vrea', 'In club', 'Pe jos', 'La vorbitor', 'In copaci', 'In picioare', 'Sub scaun', 'Sub pat', 'In cazan', 'Pe burlan', 'Acasa', 'La mine', 'Acolo', 'In vizuina', 'Unde vrea', 'Unde-apuca', 'Pe WC', 'In toaleta la McDonald\'s'];

            $this->respond($res[rand(0, count($res) - 1)] . '.');
        }

        if ($this->AI('cine e')) {
            $res = ['Nu-ti zic', 'E confidential', 'Un spart', 'Un boss', 'Sefu la patronii bossi', 'Batman', 'Omul cu chiloti peste pantaloni', 'Ala de-mprosca panza pe pereti', 'Darth Vader', 'Robin', 'Shakira', 'Un nimeni', 'Un jeg', 'O umbra pe apa', 'Sefu la shawormerie', 'Sho ce intrebare', 'Fratele meu care-mi schimba uleiu la termen', 'Un lopatar', 'Un ospatar', 'Habar n-am', 'Ma-ta'];

            $this->respond($res[rand(0, count($res) - 1)] . '.');
        }

        if ($this->AI('.*?gecko')) {
            $res = ['Nu duce numele Domnului Gecko in desert', 'Domnul Gecko are drept de ban. Just a friendly reminder'];

            $this->respond($res[rand(0, count($res) - 1)] . '.');
        }

        if ($this->AI('.*?(sok[ae]res|somarde|hasles)')) {
            $this->respond('Esti tigan. L-am anuntat pe Gecko sa-ti dea ban.');
        }

        if ($this->AI('e .*? (idiot|prost|spart|nebun|bou|ratat)')) {
            $this->respond('Despre el nu stiu multe, dar stiu ca tu imi provoci greata. De mentionat ca sunt robot.');
        }

        if ($this->AI('.')) {
            $res = ['tuci', 'situ', 'zupui', 'ecidiospor', 'ina', 'apicare', 'înnumăr', 'îmbumbi', 'răzgâia', 'sgaibă', 'varactor', 'tribrah', 'lecuță', 'moțat', 'gala', 'vădancă', 'fișiu', 'norodit', 'lambrisa', 'teacăr', 'divorțare', 'oficiat', 'porcire', 'verticaliza', 'historadiografie', 'autocratism', 'aevea', 'catafract', 'pegmatic', 'buduhoală', 'fiecine', 'patinator', 'mitralită', 'năucie', 'Cantorbery', 'kilometric', 'cinătuit', 'sângeratic', 'disodont', 'cultism', 'Breslau', 'saigi', 'magazioară', 'cucuioară', 'heruvim', 'lăidăci', 'etimorfoză', 'înderetnic', 'corupție', 'autoanaliză', 'oleaginos', 'hesperidă', 'desnădejde', 'strajameșter', 'călțun', 'tăgăduire', 'gîrtan', 'microbiuretă', 'fandasie', 'obtenebrat', 'vască', 'miț', 'Beilic', 'ceahlău', 'egofonie', 'obrejă', 'lilicea', 'gigantesc', 'valiză', 'ciocantin', 'anchilurie', 'pericolangită', 'ibriditate', 'sărcăli', 'perclu', 'hâșâit', 'picolină', 'dăngăni', 'hotru', 'dotă', 'nemolit', 'necooperativizat', 'protocarion', 'căsnicesc', 'pelinuță', 'ecoacuzie', 'tehnic', 'oligofrenopedagogie', 'împistritură', 'spilitizare', 'șițuit', 'recvizite', 'piramidotomie', 'trisecțiune', 'vitrui', 'tecto', 'mânu', 'proțăpit', 'explozor', 'recluzionar', 'păduriță', 'cloropren', 'secerică', 'kip', 'boldo', 'bălie', 'Acrisiu', 'uluci', 'pitic', 'făurie', 'contemplare', 'golîmb', 'prav', 'despăduchea', 'atomist', 'emancipare', 'graifăr', 'drăgăicuță', 'rotit', 'xilit', 'paralexematic', 'zaharimetr', 'cerestui', 'juguluit', 'zoomorfie', 'australiancă', 'păpușească', 'agamocit', 'încasatoare', 'hispida', 'combi', 'oracol', 'voci', 'întroienire', 'pseudolatinism', 'pepeșin', 'esc', 'anosmie', 'predstavlisi', 'zornăit', 'fosfatare', 'sărăcios', 'mocănesc', 'parapsihologic', 'varvara', 'fortilă', 'madă', 'aromă', 'zdrențuit', 'reunire', 'debenzolare', 'rosienesc', 'aparent', 'chioscă', 'acvafortist', 'overboust', 'șfarcă', 'reparație', 'aromat', 'rasă', 'proctotomie', 'Nicodim', 'săcuit', 'incandescent', 'bălsăma', 'Phoebus', 'goană', 'dezmeteci', 'deltaic', 'periadenoidită', 'autonega', 'lipan', 'marionetă', 'hierocrație', 'înaljos', 'menaja', 'căzător', 'lepros', 'algoritmic', 'stătător', 'orie', 'chelăcăi', 'desprejmui', 'mandril', 'brusc', 'smicui', 'suligă', 'scotocire', 'writer', 'Banya', 'portăriță', 'heliometrologie', 'afumătorie', 'tecărău', 'terifiant', 'steag', 'volubil', 'retractație', 'Vesal', 'hîrcîi', 'huțupi', 'mitacism', 'învățătoresc', 'preîmbl', 'carlovingieni', 'comisar', 'secție', 'crăngar', 'șui', 'prijuni', 'mîndrețe', 'optimist', 'francofonie', 'minicasetofon', 'emolumentar', 'răpotin', 'egzecutiv', 'psihoimunologie', 'cruntare', 'prăvilaș', 'culoglu', 'eterodoxie', 'diagnoză', 'rescizie', 'parazita', 'prăjite', 'aroga', 'despacheta', 'indentație', 'colesteropexie', 'înglotit', 'hastat', 'hinta', 'ceapol', 'fodol', 'ciorbagioaică', 'duodecimal', 'dotațiune', 'zoofitologie', 'hamailâu', 'grumăjer', 'postârnap', 'tanatic', 'cier', 'circulare', 'fustiță', 'necat', 'goangă', 'hipocondrie', 'izraelit', 'desdăuna', 'balt', 'ireconciliabil', 'cărător', 'feroșie', 'Suceava', 'dezionizat', 'șănțar', 'veda', 'mahonare', 'zăpreală', 'Milo', 'degete', 'safari', 'Olmutz', 'uniformă', 'facețios', 'melonidă', 'zbânțuitură', 'crotină', 'deeptank', 'panslavism', 'teleosteean', 'străcura', 'Pygmalion', 'ovidenie', 'pisalt', 'Tripoli', 'carambolaj', 'preacurvie', 'pasteuriza', 'drugstore', 'copiant', 'ciclan', 'poghircă', 'streșinire', 'hibernom', 'vielă', 'anastaltic', 'îngreca', 'pidea', 'droghistă', 'străluminare', 'izobilateral', 'extinguibil', 'safardea', 'zângăt', 'duldură', 'heteronomie', 'sporișin', 'inula', 'țarina', 'Adria', 'spiraea', 'ligulat', 'curățătorie', 'pleiofag', 'antepulsie', 'sfârâioc', 'Precup', 'vigoroso', 'crămăluială', 'rubiaceu', 'harmată', 'monogamic', 'anahoret', 'dintâi', 'frunzătură', 'colmataj', 'haihai', 'șutar', 'ironic', 'efilat', 'chiftiriță', 'furnicare', 'hărșuire', 'regentat', 'amniotic', 'acintus', 'bâlbără', 'intervocalic', 'reasigurator', 'sigilografie', 'interfix', 'tobă', 'moscălesc', 'depravat', 'răgăduială', 'repartiza', 'julgheală', 'fonotip', 'propurta', 'cobie', 'specifica', 'mercurit', 'denumi', 'boierit', 'atrium', 'melancolizat', 'acrospor', 'microscopie', 'megohm', 'izomerizat', 'șelământ', 'ieftini', 'puhab', 'fitotomie', 'oculogramă', 'techno', 'mulțumeală', 'hanap', 'povăț', 'mătușel', 'sindesmotomie', 'tendosinovită', 'epatită', 'dezacupla', 'pârsială', 'pilug', 'mîțișor', 'duodenorafie', 'târlie', 'publicește', 'târșitoare', 'scotofobie', 'cinizm', 'mânzălău', 'renaște', 'învălitoare', 'serascherlâc', 'nepurcică', 'strungălit', 'manotermometru', 'antiuman', 'frînghie', 'caliciflor', 'frigidarium', 'naira', 'pensionară', 'sadelcă', 'comemorare', 'xantogenare', 'crematoriu', 'țuțuiancă', 'tăpșit', 'pemni', 'profesoraș', 'influent', 'nânășel', 'diazota', 'mudejar', 'doctrinarizm', 'funerar', 'sezam', 'bancaizăn', 'transfila', 'sacramentalitate', 'telalâc', 'organino', 'educator', 'Grigorie', 'îmbotnița părăsita', 'găinilor', 'cerebroid', 'urbanist', 'kiang', 'martor', 'zbicit', 'neuronal', 'ospitaliere', 'pirolatru', 'stârmină', 'pomazanie', 'blocaj', 'chintă', 'coșcov', 'conspectare', 'tabără', 'kiwi', 'semiotic', 'lai', 'manilovism', 'cuazi', 'tedaric', 'conjor', 'funicul', 'morfinoman', 'quassia', 'șuibăr', 'demacadamizare', 'șumăriță', 'scilla', 'ancora', 'sidilă', 'nevăstuie', 'natrit', 'verificăciune', 'maiou', 'psihiatric', 'protofosfură', 'Herder', 'discromie', 'furtun', 'înflocos', 'indolog', 'munci', 'jacard', 'abstracto', 'Atalia', 'țără', 'etnologie', 'smiorcăială', 'unalta', 'smult', 'iriță', 'blestemăție', 'Iacobdeal', 'împachetare', 'purpuraceu', 'cetioară', 'indivizie', 'cronometrare', 'multifocal', 'încrânceni', 'supratehniciza', 'greime', 'astrospectrografie', 'aerobacter', 'reghie', 'piocolpos', 'dumbăț', 'șopârlă', 'iavaș', 'halucinogen', 'Foe', 'spovedi', 'amigdaleu', 'cărăzuire', 'calamina', 'stepare', 'egirin', 'Ieremia', 'dubleu', 'supresor', 'sucomba', 'nervil', 'lăcșor', 'meșteșugăresc', 'remizare', 'dodoloiu', 'da', 'nu', 'portocale'];

            $this->respond(ucwords($res[rand(0, count($res) - 1)]) . '.');
        }
    }
}