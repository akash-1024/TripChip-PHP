<?php

$host = "localhost";
$username = "root";
$password = "root";
$database = "railway";

$conn = mysqli_connect($host, $username, $password, $database);
$sourceCode = $_GET['source'];
$destCode = $_GET['dest'];
$dateCode = $_GET['date'];

//function directTrain($src, $dest) {
//    echo $src;
//    $trainCodeSrc = array();
//
//    $trainCodeDest = array();
//
//    $query = "SELECT `train_number` FROM `routes` WHERE `station_code` LIKE '$src'";
//    echo $query;
//
//    $result = mysqli_query($GLOBALS['conn'], $query);
//    while ($record = mysqli_fetch_assoc($result)) {
//        array_push($trainCodeSrc, $record['train_number']);
//    }
//
//    $query = "SELECT `train_number` FROM `routes` WHERE `station_code` LIKE '$dest'";
//
//    $result = mysqli_query($GLOBALS['conn'], $query);
//    while ($record = mysqli_fetch_assoc($result)) {
//        array_push($trainCodeDest, $record['train_number']);
//    }
//
//    return array_intersect($trainCodeSrc, $trainCodeDest);
//}


function top30Trains($src, $dest, $date) {
    $time_start = microtime(true);

    $dayCode = date("w", strtotime($date));
    //echo $dayCode . "<br/><br/><br/>";

    $top80 = ["AADR","AAG","AAH","AAK","AAL","AAM","AAS","AAY","AB","ABD","ABFC","ABH","ABI","ABKA","ABKP","ABLE","ABP","ABR","ABS","ABZ","ACL","ACLE","ACND","AD","ADB","ADD","ADF","ADH","ADI","ADIJ","ADQ","ADR","ADRA","ADST","ADT","ADTL","ADTP","ADVI","AED","AF","AFK","AFR","AGB","AGC","AGI","AGL","AGMN","AGN","AGR","AGY","AGZ","AH","AHA","AHD","AHH","AHLR","AHN","AI","AIA","AIG","AII","AIT","AJE","AJI","AJJ","AJK","AJNI","AJP","AJU","AK","AKD","AKE","AKJ","AKN","AKOR","AKOT","AKP","AKR","AKRD","AKT","AKU","AKV","AKVD","AL","ALAI","ALB","ALD","ALER","ALJ","ALJN","ALLP","ALM","ALMR","ALPR","ALU","ALW","ALY","AMAN","AMB","AMBR","AMC","AME","AMG","AMH","AMI","AML","AMLA","AMLI","AMP","AMPA","AMPL","AMPR","AMQ","AMRO","AMSA","AMW","AMX","AMY","AN","ANA","ANAH","ANAS","ANB","ANDI","ANDN","ANE","ANF","ANG","ANGL","ANH","ANI","ANK","ANKL","ANMD","ANND","ANO","ANPR","ANR","ANSB","ANTU","ANU","ANV","ANVR","ANVT","ANY","AO","AONI","AP","APA","APD","APDJ","API","APK","APL","APN","APR","APT","APTA","AQG","ARA","ARD","ARE","ARGD","ARJ","ARK","ARN","ARNA","ARPL","ARQ","ARV","ARW","AS","ASAF","ASH","ASK","ASKN","ASL","ASN","ASR","AST","ASV","AT","ATE","ATH","ATL","ATMO","ATNR","ATP","ATR","ATRU","ATS","ATT","ATU","ATUL","AUB","AUBR","AUWA","AVD","AVK","AVN","AVRD","AVS","AWB","AWM","AWP","AWR","AWY","AXA","AXK","AXR","AY","AYRN","AZ","AZR","BAB","BABR","BAE","BAGD","BAGL","BAHI","BAI","BAK","BAKA","BAL","BALE","BALR","BALU","BAM","BAMA","BAMR","BAND","BANE","BANI","BANO","BAO","BAP","BAQ","BAR","BARH","BARL","BAT","BATL","BAU","BAW","BAY","BAZ","BBA","BBAI","BBD","BBGN","BBK","BBKR","BBM","BBMN","BBN","BBPM","BBS","BBTR","BBU","BBY","BCA","BCH","BCHL","BCK","BCN","BCOB","BCQ","BCRD","BCT","BCU","BCY","BD","BDBP","BDC","BDCR","BDDR","BDH","BDHY","BDI","BDJ","BDL","BDM","BDN","BDNP","BDPL","BDRL","BDTS","BDU","BDVL","BDVR","BDVT","BDW","BDWA","BDWD","BDWL","BDWS","BDXX","BDY","BDYK","BDZ","BE","BEA","BEAS","BEB","BEF","BEG","BEH","BEHR","BEHS","BEK","BELA","BER","BET","BEW","BEY","BFD","BFE","BFJ","BFM","BFR","BFT","BFY","BG","BGA","BGAE","BGBR","BGG","BGH","BGHI","BGHU","BGK","BGKT","BGM","BGMR","BGP","BGPL","BGPR","BGQ","BGRA","BGS","BGSF","BGTA","BGU","BGUA","BGVN","BGX","BGY","BGZ","BH","BHB","BHBK","BHC","BHD","BHET","BHJA","BHKD","BHL","BHLA","BHLE","BHLK","BHLP","BHME","BHNE","BHNS","BHP","BHRL","BHS","BHT","BHTA","BHTK","BHTL","BHTN","BHTR","BHU","BHUJ","BHW","BHWA","BHX","BIA","BIC","BID","BIDR","BIG","BIH","BIJ","BIJR","BIK","BILD","BIM","BINA","BIO","BIQ","BIRD","BIWK","BIX","BIY","BJ","BJD","BJE","BJF","BJG","BJIH","BJK","BJMD","BJN","BJNR","BJO","BJP","BJQ","BJR","BJRI","BJU","BJUD","BJW","BKA","BKG","BKH","BKI","BKIT","BKJ","BKL","BKLE","BKN","BKNG","BKO","BKP","BKPT","BKRD","BKRO","BKSC","BKSL","BKTH","BKTL","BL","BLAX","BLC","BLD","BLDA","BLDI","BLG","BLGR","BLGT","BLH","BLK","BLL","BLLI","BLM","BLMK","BLMR","BLNI","BLNR","BLO","BLPE","BLPR","BLPU","BLQR","BLR","BLRD","BLS","BLSA","BLSN","BLT","BLTR","BLU","BLW","BLWR","BLX","BLY","BLZ","BMB","BMCK","BMD","BME","BMF","BMGA","BMGM","BMH","BMI","BMK","BMKD","BMKI","BMKJ","BMLL","BMN","BMNL","BMO","BMPL","BMR","BMRN","BMT","BMU","BN","BNC","BNCE","BNDA","BNDI","BNDM","BNDP","BNE","BNGN","BNI","BNL","BNLW","BNN","BNO","BNP","BNR","BNS","BNT","BNTL","BNU","BNV","BNVD","BNW","BNWC","BNXR","BNZ","BOBS","BOD","BOE","BOF","BOG","BOI","BOJ","BOKE","BOKR","BOM","BOMN","BON","BONA","BOR","BORA","BOT","BOW","BOY","BOZ","BP","BPA","BPB","BPC","BPD","BPF","BPH","BPHB","BPK","BPKA","BPL","BPO","BPP","BPQ","BPRD","BPRH","BPRS","BPS","BPY","BPZ","BQA","BQE","BQG","BQI","BQM","BQN","BQP","BQQ","BQR","BQU","BR","BRAG","BRAM","BRB","BRBS","BRC","BRD","BRE","BRG","BRGA","BRGL","BRGT","BRGW","BRH","BRJN","BRK","BRKA","BRLA","BRLY","BRM","BRMD","BRMO","BRN","BRNA","BRND","BRPL","BRPT","BRR","BRRD","BRRG","BRS","BRTK","BRU","BRUD","BRVR","BRW","BRWD","BRYA","BRZ","BSAE","BSB","BSBR","BSC","BSDP","BSE","BSI","BSKH","BSKO","BSKR","BSL","BSLE","BSM","BSP","BSPL","BSPN","BSPR","BSPX","BSQ","BSQP","BSR","BSRL","BSRX","BSS","BSSL","BST","BSTP","BSX","BSYA","BTA","BTBR","BTD","BTE","BTG","BTH","BTI","BTIC","BTJ","BTJL","BTK","BTKP","BTL","BTO","BTP","BTPD","BTQ","BTR","BTRA","BTS","BTSD","BTT","BTTR","BTU","BTV","BTW","BTX","BTY","BU","BUA","BUD","BUDI","BUDM","BUG","BUH","BUI","BUJ","BUL","BUP","BUPH","BURN","BUT","BUU","BUW","BUX","BV","BVA","BVB","BVC","BVH","BVI","BVL","BVM","BVN","BVNR","BVP","BVQ","BVRM","BVRT","BVZ","BWA","BWB","BWD","BWH","BWI","BWIP","BWK","BWL","BWM","BWN","BWR","BWS","BWSN","BWT","BWW","BWX","BXA","BXC","BXJ","BXM","BXN","BXP","BXR","BXY","BYC","BYD","BYL","BYN","BYNR","BYPL","BYR","BYS","BYT","BZA","BZG","BZLE","BZM","BZN","BZO","BZR","BZU","BZY","CAA","CAER","CAF","CAG","CAI","CAJ","CAN","CAP","CAPE","CAR","CBE","CBF","CBG","CBJ","CBK","CBM","CBN","CBSA","CC","CCA","CCH","CCI","CCK","CCT","CD","CDA","CDG","CDGR","CDH","CDL","CDM","CDMR","CDSL","CE","CEL","CEM","CEU","CGI","CGL","CGN","CGR","CGS","CGY","CH","CHA","CHB","CHBT","CHCR","CHD","CHDX","CHE","CHH","CHI","CHJ","CHJC","CHKE","CHL","CHLK","CHM","CHNN","CHNR","CHOK","CHP","CHPT","CHR","CHRA","CHRG","CHRM","CHSM","CHTI","CHV","CHZ","CI","CIL","CIT","CIV","CJ","CJL","CJM","CJN","CJR","CJS","CJW","CKB","CKD","CKDL","CKHS","CKI","CKNI","CKOD","CKP","CKR","CKS","CKTD","CKU","CKX","CLDB","CLDR","CLDY","CLE","CLF","CLG","CLI","CLJ","CLKA","CLO","CLPE","CLR","CLT","CLU","CLVR","CLX","CMA","CMDP","CMNR","CMU","CMW","CMX","CMZ","CNA","CNB","CNC","CND","CNDB","CNDM","CNGR","CNI","CNK","CNL","CNO","CNPR","CNS","COA","COI","COO","COR","CPA","CPD","CPDR","CPH","CPJ","CPK","CPL","CPLE","CPN","CPP","CPR","CPS","CPT","CPU","CPW","CQA","CRJ","CRKR","CRL","CRLM","CRP","CRR","CRU","CRW","CRWL","CRY","CSA","CSB","CSDR","CSN","CSTM","CSZ","CT","CTA","CTC","CTF","CTH","CTKT","CTMP","CTND","CTO","CTPE","CTR","CTS","CTT","CTTP","CTYL","CU","CUE","CUK","CUPJ","CUR","CUX","CV","CVB","CVJ","CVP","CVR","CW","CWA","CWI","CWR","CX","CYN","DAA","DAB","DABN","DAD","DAJ","DAKA","DAKE","DAL","DAM","DAN","DAO","DAPD","DAR","DARA","DAS","DAV","DAVM","DBA","DBB","DBD","DBEC","DBF","DBG","DBI","DBKA","DBL","DBO","DBR","DBRG","DBRT","DBU","DBV","DBY","DC","DCU","DD","DDA","DDCE","DDE","DDJ","DDL","DDN","DDP","DDR","DDX","DEB","DEC","DEE","DEEG","DEG","DEHR","DEL","DEOR","DEOS","DER","DES","DG","DGA","DGDG","DGG","DGHA","DGHR","DGI","DGLE","DGO","DGPP","DGR","DGS","DGT","DGU","DGW","DHA","DHD","DHE","DHG","DHI","DHN","DHND","DHNE","DHO","DHPR","DHR","DHRJ","DHRR","DHS","DHT","DHU","DHW","DIA","DIG","DIH","DIL","DING","DINR","DIR","DISA","DIVA","DIW","DJ","DJG","DJHR","DJRZ","DJS","DJX","DKC","DKD","DKDE","DKGS","DKJ","DKLU","DKN","DKNT","DKO","DKRA","DKS","DKT","DKZ","DL","DLB","DLC","DLD","DLGN","DLI","DLJ","DLK","DLN","DLO","DLP","DLPH","DLQ","DLR","DMBR","DMG","DMGN","DMK","DMLE","DMM","DMN","DMNJ","DMO","DMP","DMRT","DMRX","DMT","DMV","DMW","DNA","DND","DNDI","DNE","DNEA","DNK","DNKL","DNM","DNN","DNR","DNRA","DNRE","DNRP","DNT","DNV","DNW","DNWH","DNX","DO","DOA","DOD","DOE","DOH","DOL","DOS","DOTL","DOZ","DPA","DPC","DPE","DPH","DPJ","DPR","DPS","DPU","DPUR","DPX","DPZ","DQG","DQN","DQR","DR","DRB","DRD","DRH","DRI","DRL","DRLA","DRR","DRS","DRSN","DRTP","DRU","DRW","DRWN","DRZ","DS","DSA","DSD","DSJ","DSL","DSNI","DSO","DSPN","DSS","DTAE","DTL","DTO","DTP","DTRA","DTV","DTVL","DUA","DUB","DUBH","DUD","DUI","DUJ","DUMK","DUN","DURE","DURG","DUSI","DVD","DVG","DVL","DWD","DWG","DWK","DWLE","DWO","DWP","DWR","DWV","DWX","DWZ","DXD","DXG","DXK","DXN","DXR","DY","DYD","DYE","DZA","ED","EDD","EE","EKC","EKI","EKM","EKMA","EKN","EKR","ELM","EN","ERL","ERN","ERS","ET","ETM","ETP","ETW","EVA","FA","FAN","FBD","FBG","FD","FDB","FDK","FDN","FGR","FGSB","FHT","FK","FKA","FKG","FKM","FL","FLD","FLK","FLR","FM","FSP","FSR","FTG","FTP","FTS","FUT","FYZ","FZD","FZL","FZR","G","GA","GAD","GADH","GADJ","GAE","GAGA","GAJ","GALE","GAM","GANG","GANL","GAP","GAR","GAYA","GB","GBA","GBB","GBD","GBE","GBP","GBX","GCH","GCT","GD","GDA","GDB","GDE","GDG","GDGN","GDI","GDL","GDM","GDO","GDPL","GDPT","GDQ","GDR","GDV","GDX","GDYA","GDZ","GEA","GED","GEK","GER","GFAE","GGA","GGAR","GGB","GGC","GGD","GGJ","GGN","GGO","GGR","GGT","GH","GHAI","GHD","GHGL","GHH","GHJ","GHLE","GHPU","GHQ","GHR","GHUM","GHX","GHY","GID","GILL","GIMB","GIN","GIZ","GJ","GJD","GJH","GJJ","GJL","GJS","GJUT","GK","GKB","GKC","GKH","GKJ","GKK","GKM","GKP","GLA","GLE","GLG","GLGT","GLH","GLNA","GLP","GLPT","GLTA","GLU","GLY","GMA","GMAN","GMD","GMDA","GMDN","GMH","GMIA","GMM","GMO","GMR","GMS","GNA","GNC","GNG","GNGD","GNH","GNNA","GNO","GNP","GNR","GNST","GNT","GNU","GNVR","GNW","GOA","GOC","GOGH","GOH","GOK","GOL","GOP","GOTN","GOY","GP","GPAE","GPB","GPD","GPDE","GPH","GPI","GPJ","GPR","GPU","GPY","GQL","GR","GRA","GRB","GRBL","GRD","GRF","GRH","GRI","GRJA","GRL","GRMA","GRMP","GRMR","GRN","GRO","GRRU","GRX","GRY","GSP","GSPR","GSW","GT","GTE","GTF","GTJT","GTK","GTL","GTLM","GTM","GTNR","GTS","GTST","GTT","GTU","GTW","GTX","GUD","GUG","GUH","GUNA","GUP","GUR","GUU","GUV","GUX","GVB","GVD","GVG","GVI","GVL","GVMR","GVN","GW","GWA","GWD","GWL","GWM","GWS","GWV","GY","GYM","GYN","GZB","GZH","GZL","GZM","GZN","GZO","HAA","HAD","HAN","HAPA","HAQ","HAS","HAT","HBD","HBJ","HBL","HBLN","HBS","HBW","HCNR","HCP","HCR","HD","HDA","HDB","HDD","HDE","HDK","HDL","HDN","HDP","HDU","HDW","HEM","HER","HFZ","HG","HGH","HGI","HGL","HGR","HGT","HHD","HIJ","HIL","HIP","HIR","HJI","HJL","HJP","HKG","HKL","HKP","HKR","HLAR","HLDD","HLDR","HLK","HLKT","HLN","HLR","HLZ","HM","HMG","HMH","HMI","HMR","HMRR","HMT","HN","HNA","HNK","HNL","HNM","HNMN","HNS","HOJ","HOL","HP","HPG","HPLE","HPP","HPT","HPU","HQR","HRB","HRG","HRH","HRI","HRNR","HRR","HRS","HRT","HRV","HRW","HSA","HSD","HSI","HSK","HSP","HSR","HSRA","HSX","HTC","HTE","HTK","HTZ","HTZU","HUP","HVD","HVM","HVR","HW","HWH","HWT","HX","HYB","HYG","HYT","HZD","HZR","IAA","IB","IBL","IDG","IDH","IDR","IGP","IGU","IJK","IKI","IKK","IKR","INDB","INJ","INK","INP","IP","IPL","IPM","IPPM","IPR","IQB","IQG","IRP","ISA","ISH","ISM","ITA","ITR","J","JAA","JAB","JAC","JACN","JAIS","JAJ","JAL","JALD","JAM","JAMA","JAN","JAO","JAQ","JAT","JBG","JBK","JBN","JBP","JBX","JCL","JDB","JDDA","JDH","JDI","JDL","JDN","JER","JES","JEUR","JGA","JGD","JGDL","JGJ","JGM","JGN","JGR","JHD","JHIR","JHL","JHN","JHS","JHW","JIA","JID","JIND","JIT","JITE","JJG","JJK","JJKR","JJR","JKA","JKB","JKE","JKM","JKN","JKO","JKPR","JKZ","JL","JLD","JLL","JLN","JLR","JLS","JLW","JM","JMD","JMG","JMK","JMKT","JMP","JMPT","JMQ","JMS","JMT","JMU","JMV","JNA","JND","JNH","JNL","JNN","JNO","JNR","JNRD","JNRI","JNTR","JNU","JO","JOA","JOB","JOC","JOL","JOM","JOP","JOR","JP","JPD","JPE","JPG","JPH","JPL","JPS","JPZ","JRA","JRC","JRG","JRJ","JRK","JRL","JRLE","JRLI","JRMG","JRR","JRS","JRT","JRU","JRW","JRWN","JSG","JSM","JSME","JSP","JSR","JSV","JTB","JTI","JTJ","JTL","JTO","JTR","JTS","JTT","JTTN","JTW","JTY","JU","JUC","JUD","JUDW","JUJA","JUK","JUL","JUNX","JUP","JUR","JVN","JW","JWB","JWL","JWO","JWP","JYG","JYM","JYP","KAD","KAG","KAH","KAI","KAJ","KAJG","KAL","KALS","KAMG","KAN","KANJ","KANO","KAP","KAPG","KAQ","KAR","KART","KASR","KASU","KAT","KATI","KATL","KAV","KAW","KAWR","KAYR","KBA","KBH","KBJ","KBK","KBL","KBM","KBN","KBPR","KBQ","KBRV","KBSH","KCA","KCC","KCD","KCG","KCI","KCJ","KCKI","KCM","KCN","KCP","KCR","KCT","KCV","KCVL","KD","KDG","KDHA","KDI","KDJR","KDL","KDLG","KDLR","KDM","KDMR","KDN","KDNL","KDO","KDP","KDPA","KDPR","KDQ","KDSD","KDT","KDTN","KDTR","KDU","KDZ","KEA","KEB","KEF","KEG","KEH","KEI","KEJ","KEK","KEM","KEN","KEPR","KER","KESR","KFA","KFD","KFF","KFI","KFPR","KFV","KGA","KGB","KGBS","KGF","KGG","KGI","KGL","KGLE","KGM","KGN","KGP","KGQ","KGS","KGX","KH","KHAT","KHBJ","KHC","KHDB","KHDI","KHED","KHM","KHN","KHNM","KHNR","KHRJ","KHRK","KHS","KHT","KHTG","KHTU","KHU","KI","KIAT","KIK","KIKA","KIM","KIN","KIP","KIR","KIS","KIT","KIUL","KIV","KJ","KJG","KJH","KJI","KJJ","KJM","KJME","KJN","KJT","KJU","KJW","KJY","KJZ","KK","KKA","KKAH","KKB","KKD","KKDE","KKDI","KKG","KKGM","KKHT","KKI","KKJ","KKLR","KKLU","KKM","KKN","KKP","KKPM","KKRD","KKRM","KKTA","KKU","KKW","KKZ","KL","KLA","KLAR","KLB","KLD","KLDI","KLG","KLGD","KLH","KLJ","KLK","KLL","KLMG","KLMR","KLNK","KLNP","KLP","KLPG","KLPM","KLQ","KLRE","KLRS","KLT","KLTR","KLU","KLV","KLX","KLYT","KMA","KMAE","KMAH","KMBL","KMC","KMD","KMDR","KMEZ","KMH","KMI","KMJ","KMK","KML","KMLI","KMLR","KMME","KMNC","KMNR","KMQ","KMQA","KMS","KMSD","KMST","KMT","KMTI","KMU","KMV","KMX","KMZ","KN","KND","KNDP","KNE","KNGN","KNHN","KNHP","KNJ","KNJJ","KNKT","KNL","KNLP","KNLS","KNN","KNO","KNP","KNPR","KNPS","KNR","KNRG","KNRT","KNSR","KNT","KNVT","KNW","KO","KOAA","KODI","KOHR","KOI","KOJ","KOL","KOLR","KON","KONN","KONY","KOO","KOP","KOTA","KOTI","KOTT","KOU","KOV","KOX","KP","KPA","KPD","KPG","KPGM","KPI","KPK","KPL","KPLE","KPLL","KPN","KPNA","KPP","KPQ","KPRD","KPRR","KPTN","KPTO","KPU","KPV","KPY","KPZ","KQA","KQD","KQE","KQK","KQN","KQQ","KQR","KQT","KQU","KQW","KRA","KRAI","KRAN","KRAR","KRBA","KRBP","KRCD","KRD","KRDL","KRE","KRG","KRH","KRHA","KRIH","KRJ","KRJD","KRL","KRLI","KRLR","KRLS","KRMA","KRMI","KRMR","KRND","KRNR","KRNT","KRP","KRPP","KRPR","KRPU","KRR","KRS","KRSA","KRSL","KRTH","KRV","KRW","KRY","KS","KSB","KSC","KSD","KSE","KSF","KSG","KSH","KSI","KSJ","KSK","KSM","KSN","KSNG","KSP","KSPR","KSRA","KSTE","KSTH","KSU","KSV","KSVM","KSW","KSWR","KSX","KT","KTA","KTCR","KTD","KTE","KTES","KTGA","KTH","KTHD","KTHU","KTJ","KTK","KTKA","KTKH","KTKL","KTKR","KTM","KTMA","KTO","KTOA","KTQ","KTR","KTRH","KTSH","KTT","KTU","KTV","KTW","KTYM","KUA","KUC","KUD","KUDA","KUDL","KUE","KUF","KUG","KUH","KUI","KUK","KUN","KUP","KUR","KURJ","KUT","KUTI","KUU","KUV","KUX","KVDU","KVG","KVGM","KVJ","KVK","KVLS","KVM","KVR","KVS","KVU","KVZ","KWAE","KWE","KWGN","KWI","KWM","KWN","KWO","KWP","KWR","KWV","KXA","KXB","KXE","KXG","KXH","KXI","KXL","KXN","KXP","KXT","KXX","KY","KYE","KYF","KYI","KYJ","KYM","KYN","KYOP","KYQ","KYT","KYX","KZA","KZB","KZE","KZJ","KZK","KZQ","KZS","KZT","KZTW","KZU","KZY","LAE","LAR","LAU","LAV","LBA","LBG","LBN","LC","LCAE","LD","LDA","LDH","LDP","LDR","LDW","LDX","LEDO","LGCE","LGDH","LGH","LGL","LGO","LHA","LHB","LHD","LHLL","LHN","LHU","LIN","LJN","LJR","LKA","LKBL","LKD","LKDU","LKE","LKKD","LKMR","LKN","LKNA","LKO","LKR","LKS","LKT","LKU","LKW","LKY","LLD","LLGM","LLH","LLI","LLJ","LLPR","LLR","LM","LMC","LMD","LMG","LMK","LMM","LMN","LMNR","LMO","LMP","LMT","LNA","LNK","LNL","LNN","LNR","LNT","LOA","LOL","LONI","LOV","LPH","LPI","LPJ","LPR","LR","LRD","LRJ","LRU","LS","LSD","LSE","LSG","LSI","LSR","LSX","LTD","LTHR","LTR","LTRR","LTT","LUNI","LUR","LUSA","LWR","LWS","LXA","LXR","MA","MAA","MABA","MABD","MAD","MAE","MAG","MAGH","MAHE","MAHO","MAI","MAJN","MAKM","MAKR","MALB","MALK","MALM","MAM","MAN","MANG","MANK","MAO","MAP","MAQ","MAR","MAS","MAU","MAUR","MAY","MB","MBA","MBB","MBD","MBF","MBI","MBL","MBM","MBNL","MBNR","MBS","MBY","MCA","MCI","MCN","MCPE","MCQ","MCRD","MCS","MCU","MCV","MCVM","MDB","MDDP","MDE","MDGR","MDH","MDJ","MDJN","MDKU","MDL","MDN","MDNR","MDP","MDPB","MDPD","MDPR","MDR","MDRR","MDS","MDU","MDVK","MDVL","MDW","ME","MED","MEJ","MEM","MEP","MET","MEX","MFJ","MFKA","MFL","MFP","MFQ","MGAE","MGB","MGC","MGF","MGG","MGL","MGLE","MGLP","MGM","MGME","MGN","MGRD","MGRL","MGS","MHAD","MHBT","MHD","MHH","MHJ","MHN","MHO","MHOW","MHPE","MHQ","MHRG","MHT","MHU","MHV","MID","MIH","MIK","MIL","MIN","MINA","MINJ","MIPM","MIQ","MJ","MJA","MJBK","MJF","MJG","MJL","MJN","MJP","MJRI","MJS","MJY","MK","MKA","MKB","MKC","MKDD","MKDI","MKDN","MKH","MKL","MKN","MKO","MKP","MKPR","MKPT","MKR","MKRA","MKRD","MKRH","MKRN","MKS","MKSR","MKT","MKU","MKX","ML","MLAR","MLB","MLC","MLD","MLDT","MLG","MLGH","MLGT","MLHA","MLI","MLJ","MLK","MLM","MLMR","MLN","MLNH","MLO","MLP","MLPR","MLSU","MLTR","MLV","MLY","MLZ","MMA","MMB","MMD","MMDA","MME","MMH","MMK","MMKB","MML","MMM","MMPL","MMR","MMS","MMV","MMVR","MMY","MMZ","MNAE","MNC","MND","MNDH","MNDR","MNE","MNF","MNGD","MNI","MNJ","MNL","MNM","MNO","MNP","MNQ","MNSR","MNTT","MNU","MNV","MNVL","MO","MOA","MOB","MOF","MOG","MOGA","MOI","MOJ","MOL","MOM","MOMU","MON","MONR","MOO","MOP","MOR","MOT","MOTC","MOTH","MOU","MOW","MOZ","MPA","MPH","MPJ","MPL","MPLM","MPLR","MPR","MPU","MPY","MQ","MQE","MQL","MQN","MQO","MQR","MQS","MQU","MQX","MR","MRA","MRB","MRBL","MRDD","MRDL","MRDW","MRE","MRF","MRG","MRGA","MRHT","MRJ","MRK","MRL","MRM","MRN","MRND","MRPL","MRPR","MRR","MRT","MRTL","MRTY","MRV","MS","MSDN","MSDR","MSH","MSK","MSMD","MSO","MSR","MST","MSW","MSZ","MTB","MTC","MTD","MTDM","MTHP","MTJ","MTM","MTP","MTPC","MTPR","MTR","MTSK","MTU","MTY","MUA","MUD","MUE","MUG","MUGA","MUGR","MUK","MULK","MUM","MUP","MUR","MURD","MURI","MUT","MUV","MUW","MV","MVD","MVE","MVF","MVG","MVH","MVI","MVJ","MVLK","MVN","MVO","MVPM","MVV","MVW","MW","MWE","MWH","MWJ","MWK","MWM","MWRN","MWT","MWW","MWX","MWY","MXA","MXH","MXK","MXL","MXM","MXN","MXO","MXT","MYA","MYG","MYK","MYL","MYM","MYR","MYS","MYX","MYY","MZC","MZH","MZL","MZM","MZP","MZR","NAB","NAC","NAD","NAK","NAM","NAN","NANA","NAND","NANR","NASP","NAT","NAVI","NAW","NAWN","NAZJ","NB","NBA","NBD","NBG","NBH","NBI","NBL","NBM","NBPH","NBQ","NBR","NCB","NCH","NCJ","NCR","NCU","ND","NDAE","NDB","NDD","NDJ","NDKD","NDL","NDLS","NDN","NDO","NDPR","NDPU","NDR","NDT","NDU","NDW","NDZ","NED","NEO","NEP","NEW","NFK","NG","NGA","NGAN","NGB","NGE","NGF","NGG","NGHW","NGI","NGLT","NGN","NGNT","NGO","NGP","NGR","NGS","NGT","NGTN","NH","NHH","NHK","NHLG","NHM","NHN","NHT","NHY","NIA","NIDI","NIIJ","NIL","NILE","NIM","NIQ","NIRA","NIU","NIV","NJP","NJT","NK","NKD","NKDO","NKE","NKI","NKJ","NKM","NKP","NKR","NKW","NKX","NLD","NLDA","NLDM","NLE","NLI","NLKR","NLPD","NLR","NLS","NLV","NMD","NMDA","NMGY","NMH","NMJ","NMK","NMKL","NMT","NMX","NMZ","NN","NNA","NNE","NNGE","NNGL","NNL","NNN","NNO","NNP","NNR","NNW","NOI","NOK","NOL","NOMD","NOQ","NPD","NPI","NPK","NPL","NPNR","NPRD","NPS","NPW","NQR","NR","NRA","NRD","NRDP","NRE","NRG","NRGO","NRGR","NRI","NRK","NRKR","NRL","NRLN","NRLR","NRM","NRO","NRP","NRPA","NRR","NRS","NRT","NRW","NRX","NRYP","NRZB","NS","NSD","NSL","NSU","NSVP","NSX","NTSK","NTV","NTW","NTZ","NU","NUD","NUJ","NUQ","NUR","NVG","NVLN","NVRD","NVS","NVT","NVU","NW","NWB","NWD","NWP","NWR","NWU","NXN","NYG","NYH","NYI","NYK","NYN","NYO","NYP","NYY","NZB","NZD","NZM","NZT","OBM","OBR","OBVP","OCR","ODC","ODG","ODM","OEA","OGL","OKA","OKD","OKHA","OLR","OM","OML","OMLF","ON","ONR","OPL","ORAI","ORGA","ORH","ORR","OSN","OTP","OYR","PAA","PAD","PAE","PAGM","PAI","PAIL","PAK","PAM","PAN","PANP","PAO","PAP","PAR","PARD","PARH","PASA","PAU","PAV","PAVP","PAW","PAY","PAZ","PB","PBA","PBD","PBE","PBH","PBKS","PBL","PBM","PBN","PBP","PBR","PBV","PC","PCH","PCL","PCLI","PCN","PCQ","PCR","PCU","PCV","PCX","PCZ","PDA","PDD","PDG","PDGL","PDGM","PDGN","PDH","PDKN","PDKT","PDL","PDNA","PDNR","PDO","PDP","PDPL","PDQ","PDR","PDRD","PDT","PDU","PDW","PDX","PDY","PDZ","PEH","PEM","PEN","PEP","PER","PERN","PES","PFM","PFR","PFU","PG","PGA","PGG","PGI","PGK","PGP","PGR","PGRL","PGT","PGTN","PGU","PGW","PGZ","PHA","PHD","PHK","PHN","PHR","PIA","PIL","PIP","PIZ","PJB","PK","PKD","PKF","PKK","PKL","PKNS","PKO","PKPU","PKQ","PKR","PKRA","PKRD","PKU","PKW","PLCJ","PLD","PLG","PLI","PLJ","PLJE","PLK","PLMD","PLNI","PLO","PLP","PLS","PLU","PLW","PLY","PM","PMD","PMK","PMKT","PML","PMN","PMP","PMR","PMT","PMU","PMY","PN","PNBE","PNC","PND","PNDM","PNE","PNF","PNHR","PNI","PNK","PNM","PNME","PNP","PNPL","PNQ","PNSA","PNSD","PNU","PNVL","PNW","PNWN","PNYA","POA","POE","POK","POO","POR","POT","POU","POY","POZ","PP","PPC","PPD","PPF","PPG","PPH","PPI","PPJ","PPLC","PPLI","PPM","PPN","PPO","PPR","PPT","PPTA","PPZ","PQL","PQN","PRB","PRCA","PRDL","PRF","PRG","PRH","PRI","PRJ","PRKD","PRKE","PRL","PRLI","PRNA","PRND","PRNR","PRP","PRR","PRT","PRTL","PRWD","PS","PSA","PSAE","PSB","PSD","PSDA","PSL","PSLI","PSO","PSPY","PSR","PST","PTA","PTB","PTH","PTJ","PTK","PTKC","PTKP","PTLI","PTP","PTRD","PTRL","PTRU","PTT","PTU","PTWA","PTZ","PU","PUA","PUD","PUK","PUL","PUMU","PUN","PUNE","PUO","PURI","PUS","PUT","PUU","PUX","PVD","PVP","PVPT","PVR","PVRD","PVU","PWL","PWS","PYD","PYOL","QLD","QLM","QLN","QRP","QSR","R","RA","RAA","RAG","RAIR","RAJP","RAKL","RAL","RANI","RASP","RAY","RBA","RBD","RBG","RBGJ","RBK","RBL","RBS","RBZ","RC","RCJ","RDD","RDDE","RDG","RDHP","RDL","RDM","RDP","RDRA","RDT","RDUM","RE","RECH","REG","REI","REJ","REM","REN","RENH","REWA","RFJ","RG","RGB","RGD","RGDA","RGH","RGI","RGJ","RGL","RGM","RGO","RGP","RGPM","RGQ","RGS","RGU","RHA","RHE","RHG","RHN","RIG","RIKA","RJA","RJAP","RJG","RJI","RJK","RJN","RJO","RJP","RJPB","RJPM","RJR","RJS","RJT","RJY","RK","RKB","RKD","RKH","RKL","RKM","RKO","RKSH","RKSN","RKZ","RLA","RLL","RLO","RM","RMA","RMB","RMC","RMD","RMF","RMGM","RMH","RMJK","RMM","RMN","RMNP","RMP","RMPB","RMR","RMRB","RMT","RMU","RMY","RN","RNBT","RNC","RNE","RNG","RNGG","RNH","RNJD","RNL","RNN","RNO","RNPR","RNQ","RNR","RNT","RNU","RNV","RNY","ROA","ROB","ROHA","ROI","ROK","ROP","ROU","ROZA","RPAR","RPD","RPH","RPHR","RPJ","RPK","RPL","RPR","RPRD","RPRL","RPUR","RPZ","RQJ","RRB","RRGA","RRI","RRJ","RRL","RRME","RRS","RS","RSA","RSG","RSI","RSJ","RSNR","RSR","RSYI","RT","RTA","RTG","RTGH","RTI","RTM","RTP","RU","RUB","RUI","RUL","RUM","RUPC","RUR","RURA","RUSD","RV","RVD","RVKH","RWH","RWJ","RWL","RWO","RXL","RYP","RYS","RYT","S","SA","SAA","SAB","SAC","SAD","SADP","SAG","SAGR","SAH","SAI","SAL","SALE","SALI","SAN","SANR","SAO","SAP","SAPE","SAPT","SAR","SAS","SASN","SAT","SAU","SAV","SAW","SBB","SBBJ","SBC","SBD","SBE","SBG","SBHR","SBI","SBLJ","SBLT","SBM","SBNM","SBO","SBP","SBPD","SBPY","SBR","SBRA","SBT","SBV","SBW","SBZ","SC","SCC","SCE","SCH","SCI","SCKR","SCL","SCM","SCN","SCO","SCT","SDAH","SDB","SDBH","SDD","SDE","SDF","SDGH","SDGM","SDH","SDI","SDL","SDLE","SDLP","SDM","SDMD","SDN","SDNR","SDRA","SDS","SDT","SDV","SEB","SED","SEE","SEG","SEGM","SEH","SELU","SEM","SEN","SEO","SEP","SES","SET","SEU","SF","SFC","SFG","SFH","SFM","SFW","SFX","SFY","SGAM","SGBJ","SGD","SGDM","SGDP","SGE","SGF","SGG","SGJ","SGKM","SGL","SGLA","SGND","SGNR","SGO","SGP","SGPA","SGR","SGRA","SGRD","SGRL","SGRM","SGS","SGUJ","SGUT","SGV","SGZ","SHAN","SHC","SHDM","SHDR","SHE","SHF","SHG","SHJP","SHK","SHM","SHMI","SHNR","SHNX","SHR","SHSK","SHTT","SHU","SHV","SHZ","SI","SID","SIF","SIHO","SIL","SILO","SIM","SINI","SIOB","SIP","SIPR","SIQ","SIR","SIW","SJL","SJN","SJNP","SJP","SJQ","SJS","SJT","SK","SKA","SKAR","SKB","SKGH","SKI","SKJ","SKLR","SKM","SKN","SKND","SKP","SKPI","SKPT","SKQ","SKR","SKS","SKT","SKTN","SKZR","SL","SLB","SLD","SLF","SLGE","SLGH","SLGR","SLH","SLI","SLJ","SLKR","SLM","SLN","SLO","SLPM","SLR","SLS","SLT","SLW","SLY","SM","SMAE","SMBJ","SMBL","SMBX","SME","SMET","SMI","SMK","SML","SMLA","SMLG","SMNE","SMNH","SMO","SMP","SMPA","SMPR","SMQL","SMR","SMRR","SMT","SMWA","SMX","SMZ","SN","SNAR","SNC","SNDD","SNF","SNGN","SNGP","SNGR","SNH","SNI","SNJL","SNK","SNKE","SNKL","SNKR","SNL","SNLR","SNM","SNN","SNP","SNPR","SNQ","SNR","SNRR","SNS","SNSI","SNSL","SNSN","SNT","SNTD","SNV","SNVR","SNX","SOA","SOAE","SOD","SOG","SOGR","SOH","SOJN","SOL","SOM","SONI","SOP","SOR","SORO","SOS","SPC","SPDR","SPE","SPF","SPJ","SPK","SPLE","SPN","SPO","SPP","SPRD","SPT","SPX","SPZ","SQL","SQN","SQR","SR","SRAS","SRBA","SRC","SRE","SRF","SRGM","SRGT","SRI","SRID","SRJ","SRJM","SRJN","SRKI","SRL","SRMR","SRNR","SRNT","SRO","SRP","SRPJ","SRPM","SRR","SRRG","SRT","SRTL","SRTN","SRU","SRUR","SRW","SRWN","SRX","SRY","SSA","SSB","SSIA","SSKA","SSM","SSNS","SSPD","SSPN","SSR","ST","STA","STBJ","STD","STJT","STKT","STL","STLR","STN","STP","STPD","STPT","STR","STUR","STW","SUA","SUD","SUH","SUJH","SUKU","SUMR","SUNR","SUP","SUR","SURI","SURL","SUW","SV","SVA","SVD","SVDK","SVG","SVGA","SVH","SVHE","SVJR","SVKD","SVKS","SVM","SVN","SVNR","SVPI","SVPM","SVPR","SVRP","SVT","SVV","SVW","SVX","SWA","SWD","SWE","SWF","SWM","SWNI","SWO","SWPR","SWR","SWV","SXN","SXP","SXT","SY","SYA","SYC","SYJ","SYL","SYM","SYN","SYQ","SYWN","SZ","SZA","SZB","SZK","SZM","SZR","SZY","TA","TAA","TAC","TAE","TAKU","TAN","TAO","TAPA","TAR","TAT","TATA","TAZ","TBAE","TBB","TBM","TBN","TBR","TBT","TBV","TCL","TCN","TCR","TDD","TDH","TDL","TDLE","TDN","TDO","TDP","TDPR","TDU","TDV","TEA","TEL","TELO","TEN","TET","TETA","TFGN","TGA","TGH","TGL","TGM","TGN","TGP","TGQ","TGRL","TGU","THA","THAN","THB","THDR","THE","THEA","THKU","THMR","THP","THUR","THV","THVM","THY","TIA","TIG","TIHU","TIM","TIR","TIS","TISI","TIT","TIU","TIW","TJ","TJP","TK","TKB","TKBG","TKBN","TKC","TKD","TKE","TKG","TKH","TKHE","TKJ","TKMY","TKN","TKPY","TKQ","TKR","TKRI","TKU","TKWD","TL","TLC","TLD","TLE","TLGP","TLH","TLHD","TLHR","TLJ","TLKH","TLO","TLT","TLU","TLV","TLWA","TLY","TMC","TME","TMGN","TMKA","TMLU","TMQ","TMR","TMV","TMX","TMZ","TN","TNA","TNGL","TNKU","TNM","TNR","TOD","TOI","TOK","TORI","TOU","TP","TPF","TPH","TPJ","TPK","TPND","TPPI","TPQ","TPT","TPTN","TPTY","TPY","TPZ","TQA","TQN","TR","TRA","TRAN","TRB","TRK","TRKR","TRL","TRO","TRR","TRS","TRT","TRTR","TRVL","TRWT","TSA","TSF","TSI","TSK","TSL","TSR","TTB","TTI","TTL","TTR","TTU","TTZ","TU","TUA","TUL","TUN","TUNG","TUNI","TUP","TUV","TUVR","TUX","TVC","TVI","TVL","TVP","TVR","TWB","TWG","TXD","TZR","UA","UAA","UAM","UBC","UBL","UBR","UCA","UCB","UCH","UCR","UD","UDGR","UDL","UDM","UDN","UDR","UDZ","UGD","UGNA","UGR","UGWE","UHL","UHP","UHR","UJ","UJA","UJN","UJP","UKA","UKC","UKH","UKL","UKN","UKR","ULB","ULD","ULL","ULNR","ULT","UM","UMB","UMD","UMED","UMN","UMR","UMRA","UMRI","UMS","UND","UNDI","UNK","UNL","UPD","UPR","UR","URD","UREN","URGA","URI","URK","URL","URMA","URML","URN","URPR","USD","USL","UTA","UTD","UTL","UTR","UVD","VAA","VAK","VAPI","VAPM","VARD","VAT","VBL","VBR","VBW","VCN","VD","VDA","VDD","VDE","VDH","VDI","VDL","VDN","VDS","VEER","VELI","VG","VGE","VGN","VGT","VHGN","VID","VINH","VJA","VJP","VJPJ","VKA","VKB","VKH","VKI","VKN","VKR","VKT","VL","VLD","VLE","VLG","VLI","VLNK","VLR","VLT","VLY","VM","VMA","VMD","VML","VMU","VN","VNA","VNB","VND","VNM","VNRD","VNUP","VP","VPDA","VPL","VPO","VPR","VPT","VPZ","VR","VRE","VRG","VRH","VRI","VRL","VRM","VRN","VRPD","VRR","VRV","VRVL","VS","VSG","VSKP","VST","VSU","VTA","VTJ","VTM","VTN","VV","VVA","VVB","VVKN","VVM","VWA","VXD","VYA","VYK","VYN","VZM","WADI","WAIR","WANI","WC","WDLN","WDM","WDN","WDR","WDS","WEL","WENA","WFD","WG","WHM","WIRR","WJR","WKA","WKI","WKR","WKRC","WL","WND","WNG","WP","WPR","WR","WRC","WRR","WRS","WSA","WSB","WSJ","WTJ","WTP","WTR","WZJ","Y","YA","YDM","YFP","YG","YGD","YGL","YJUD","YKA","YL","YLG","YLK","YLM","YNG","YNK","YP","YPD","YPR","YT","ZARP","ZB","ZBD","ZN","ZNA","ZPI","ZPL","ZRDE","ZW"];

    $trainSource = array();
    $trainDestination = array();
    $trainTop = array();
    
    $top30 = array();
    
    foreach($top80 as $top) {
        if($top !== $src && $top != $dest) {
            array_push($top30, $top);
        }
    }
    
    //print_r($top30);

    $trainSourceTop = array();

    $trainDestinationTop = array();

    $query = "SELECT `train_number` FROM `routes` WHERE `station_code` LIKE '" . $src . "';";
    $result = mysqli_query($GLOBALS['conn'], $query);

    while ($record = mysqli_fetch_assoc($result)) {

        array_push($trainSource, $record['train_number']);
    }

    $query = "SELECT `train_number` FROM `routes` WHERE `station_code` LIKE '" . $dest . "';";
    $result = mysqli_query($GLOBALS['conn'], $query);


    while ($record = mysqli_fetch_assoc($result)) {
        array_push($trainDestination, $record['train_number']);
    }

    foreach ($top30 as $top) {
        $query = "SELECT `train_number` FROM `routes` WHERE `station_code` LIKE '" . $top . "';";
        $result = mysqli_query($GLOBALS['conn'], $query);

        $tempTop = array();

        while ($record = mysqli_fetch_assoc($result)) {
            array_push($tempTop, $record['train_number']);
        }
        array_push($trainSourceTop, array_intersect($tempTop, $trainSource));
        array_push($trainDestinationTop, array_intersect($tempTop, $trainDestination));
    }

    $trainSourceTopMaster = array();
    $trainDestinationTopMaster = array();

    $topIndex = 0;
    foreach ($trainSourceTop as $sourceTop) {

        $tempStation = array();
        foreach ($sourceTop as $train) {
            $query = "SELECT `routes`.`train_number`, `routes`.`station_code`, `routes`.`scharr`, `routes`.`schdep`, `routes`.`distance`, `routes`.`day`,"
                    . "`running_days`.`days` FROM `routes` INNER JOIN `running_days` ON"
                    . "`routes`.`train_number` = `running_days`.`train_number` WHERE `routes`.`train_number` LIKE '$train' "
                    . "AND (`station_code` LIKE '$src' OR `station_code` LIKE '$top30[$topIndex]')";
            $result = mysqli_query($GLOBALS['conn'], $query) or die(mysqli_error($GLOBALS['conn']));

            $temp = array();

            $distTop;
            $distSource;

            $daySource;
            $dayTop;

            while ($record = mysqli_fetch_assoc($result)) {
                if ($record["station_code"] == $src) {
                    $distSource = (int) $record["distance"];
                    $daySource = (int) $record["day"];
                } else if ($record["station_code"] == $top30[$topIndex]) {
                    $distTop = (int) $record["distance"];
                    $dayTop = (int) $record["day"];
                }
                array_push($temp, $record);
            }


            $dayDifference = $daySource - 1;

            $dayBinary = "0000000";


            $i = 0;
            foreach (str_split($temp[1]["days"]) as $dayBin) {

                if ($dayBin == "1") {
                    $changeDay = $i + $dayDifference;
                    if ($changeDay > 6)
                        $changeDay -= 7;
                    $dayBinary[$changeDay] = "1";
                }
                $i++;
            }

            $dayDifference = $daySource - 1;

            $dayBinaryTop = "0000000";


            $i = 0;
            foreach (str_split($temp[1]["days"]) as $dayBin) {

                if ($dayBin == "1") {
                    $changeDay = $i + $dayDifference;
                    if ($changeDay > 6)
                        $changeDay -= 7;
                    $dayBinaryTop[$changeDay] = "1";
                }
                $i++;
            }


            $dist = $distTop - $distSource;
            if ($dist > 0 && $dayBinary[$dayCode] == "1") {
                $temp[1]["distance"] = $dist;
                $temp[1]["days"] = $dayBinaryTop;
                $temp[1]["day"] = $dayTop - $daySource;
                array_push($tempStation, $temp[1]);
            }
        }
        array_push($trainSourceTopMaster, $tempStation);

        $topIndex++;
    }

    $topIndex = 0;
    foreach ($trainDestinationTop as $destinationTop) {

        $tempStation = array();
        foreach ($destinationTop as $train) {
            $query = "SELECT `routes`.`train_number`, `routes`.`station_code`, `routes`.`scharr`, `routes`.`schdep`, `routes`.`distance`, `routes`.`day`,"
                    . "`running_days`.`days` FROM `routes` INNER JOIN `running_days` ON"
                    . "`routes`.`train_number` = `running_days`.`train_number` WHERE `routes`.`train_number` LIKE '$train' "
                    . "AND (`station_code` LIKE '$dest' OR `station_code` LIKE '$top30[$topIndex]')";
            $result = mysqli_query($GLOBALS['conn'], $query) or die(mysqli_error($GLOBALS['conn']));

            $temp = array();

            $distTop;
            $distdest;

            $dayTop;

            while ($record = mysqli_fetch_assoc($result)) {
                if ($record["station_code"] == $dest) {
                    $distdest = (int) $record["distance"];
                } else if ($record["station_code"] == $top30[$topIndex]) {
                    $distTop = (int) $record["distance"];
                    $dayTop = (int) $record["day"];
                }
                array_push($temp, $record);
            }

            $dayDifference = $dayTop - 1;

            $dayBinary = "0000000";


            $i = 0;
            foreach (str_split($temp[0]["days"]) as $dayBin) {

                if ($dayBin == "1") {
                    $changeDay = $i + $dayDifference;
                    if ($changeDay > 6)
                        $changeDay -= 7;
                    $dayBinary[$changeDay] = "1";
                }
                $i++;
            }

            $dist = $distdest - $distTop;
            if ($dist > 0) {
                $temp[0]["distance"] = $dist;
                $temp[0]["day"] = $dayTop;
                $temp[0]["days"] = $dayBinary;
                array_push($tempStation, $temp[0]);
            }
        }

        array_push($trainDestinationTopMaster, $tempStation);

        $topIndex++;
    }


    $sourceTrains = array();
    $destinationTrains = array();

    $routes_array = array();

    for ($i = 0; $i < sizeof($top30); $i++) {
        if ($trainSourceTopMaster[$i] != null && $trainDestinationTopMaster[$i] != null) {
            foreach ($trainSourceTopMaster[$i] as $sourceTopMaster) {
                foreach ($trainDestinationTopMaster[$i] as $destinationTopMaster) {
                    $temp = array();
                    $temp["break_station"] = $top30[$i];
                    $temp["train_source"] = $sourceTopMaster["train_number"];
                    $temp["train_top"] = $destinationTopMaster["train_number"];
                    $temp["distance"] = (int) $sourceTopMaster["distance"] + (int) $destinationTopMaster["distance"];
                    $train_arr_day = $dayCode + (int) $sourceTopMaster["day"];
                    if ($train_arr_day > 6)
                        $train_arr_day -= 7;
                    if ($sourceTopMaster["days"][$train_arr_day] == "1") {
                        $time_arrival = $sourceTopMaster["scharr"];
                        $time_departure = "";

                        if ($destinationTopMaster["scharr"] == "Source" || $destinationTopMaster["scharr"] == "SRC") {
                            $time_departure = $destinationTopMaster["schdep"];
                        } else {
                            $time_departure = $destinationTopMaster["scharr"];
                        }



                        $time_arrival = (int) str_replace(":", "", $time_arrival);
                        $time_departure = (int) str_replace(":", "", $time_departure);

                        $time_difference = $time_departure - $time_arrival;

                        if ($time_difference > 29 && $time_difference < 230) {
                            if ($sourceTopMaster["days"][$train_arr_day] == $destinationTopMaster["days"][$train_arr_day]) {
                                array_push($routes_array, $temp);
                            }
                        } else if ($time_difference < -2128) {
                            $train_arr_day_bogus = $train_arr_day + 1;
                            if ($train_arr_day_bogus > 6)
                                $train_arr_day_bogus -= 7;
                            if ($sourceTopMaster["days"][$train_arr_day] == $destinationTopMaster["days"][$train_arr_day_bogus]) {
                                array_push($routes_array, $temp);
                            }
                        }
                    }
                }
            }
        }
    }



    usort($routes_array, function($a, $b) {
        return $a["distance"] - $b["distance"];
    });

    $valid_routes_best = array();

    $i = 0;
    while ($i < 30 && $i < count($routes_array)) {
        array_push($valid_routes_best, $routes_array[$i++]);
    }
    //echo "<font color='green'>";
    return $valid_routes_best;
    //echo "</font>";
    //$time_end = microtime(true);
    //$time = $time_end - $time_start;

}

$data = top30Trains($sourceCode, $destCode, $dateCode);

echo "<p align='center' id='alternate-heading'>Showing routes from $sourceCode to $destCode</p>";

echo "<div id='container-alternate'>";
foreach($data as $dat) {
    //print_r($dat);
    echo "<div class='route'>";
    echo "<div class='route-cont'>";
        echo "<div class='source-station'>";
            echo "<img src='../graphics/src.png' class='image-station'/>";
            echo $sourceCode;
        echo "</div>";
    echo "</div>";
    echo "<div class='route-cont'>";
        echo "<div class='rail-track'>";
        echo "</div>";
        echo "<div>";
            echo $dat["train_source"];
        echo "</div>";
    echo "</div>";
    echo "<div class='route-cont'>";
        echo "<img src='../graphics/top.png' class='image-station'/>";
        echo $dat["break_station"];
    echo "</div>";
    echo "<div class='route-cont'>";
        echo "<div class='rail-track'>";
        echo "</div>";
            echo "<div>";
                echo $dat["train_top"];
            echo "</div>";
    echo "</div>";
    echo "<div class='route-cont'>";
        echo "<img src='../graphics/src.png' class='image-station'/>";
        echo $destCode;
    echo "</div>";
    echo "<div class='distance'>";
        echo "<p class='distance-text'>".$dat["distance"]." KM</p>";
    echo "</div>";
    echo "</div>";

}
echo "</div>";
?>

<style>
    * {
        margin: 0px;
        padding: 0px;
    }

    #container-alternate {
        position: absolute;
        left: 10vw;
        width: 80vw;
        font-size: 1.4vw;
    }

    .route {
        margin-top: 10vw;
        padding-bottom: 4vw;
        padding-top: 4vw;
        box-shadow: 0px 0px 0.6vw #e6e6e6;
    }

    .route-cont {
        position: relative;
        display: inline-block;
        width: 16vw;
        text-align: center;
    }

    .image-station {
        position: relative;
        left: 50%;
        transform: translateX(-50%);
        display: block;
        width: 4vw;
        padding: 1vw;
    }

    .rail-track {
        position: absolute;
        width: 150%;
        height: 100%;
        top: -200%;
        left: -25%;
        background-size: auto 100%;
        background-image: url('../graphics/track.png');
        background-repeat: repeat-x;
    }

    .distance {
        position: relative;
        width: 80%;
        height: 50%;
        margin-top: 4vw;
        left: 10%;
        border-top: 2px solid #252525;
        text-align: center;
    }

    .distance-text {
        margin-top: 2vw;
    }

    #alternate-heading {
        margin-top: 5vw;
        font-size: 2vw;
    }


</style>