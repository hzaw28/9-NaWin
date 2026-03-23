<?php
    // Default timezone ကိုထည့်ထားသည်။ ကိုယ်နေသည့် timezone ကိုမူတည်ပြီးပြောင်း
    date_default_timezone_set('America/New_York');

    // **************************************************
    // ဘယ်လိုပြမယ်ကြိုသိချင်လျှင် နောက်လာမည့် ရက်အရေအတွက်ကို ဒီမှာထည့် 
    $AddDaysForSimulation = 0;
    $Today = strtotime((string) date("Y-m-d"));
    // **************************************************

    // အဓိဋ္ဌာန် စဝင်တဲ့နေ့
    $StartDate = strtotime("2026-02-02");
    // အဓိဋ္ဌာန် ပြီးဆုံးမည့်
    $DeterminationEndDate = strtotime("80 day", $StartDate);

    // ယနေ့
    $Today = strtotime($AddDaysForSimulation." days", $Today);
    // မနက်ဖြန်
    $Tomorrow = strtotime("1 day", $Today);

    // ဘုရား ဂုဏ်တော် ၉ ပါးကို output ထုတ်လို့လွယ်အောင် array ထဲထည့်
    $GongDaw = [[null,null],
        ["အရဟံ","ကိလေသာကင်းစင်၍ အမြတ်ဆုံး ပုဂ္ဂိုလ်ဖြစ်ခြင်း၊ လူနတ်ဗြဟ္မာတို့၏ ပူဇော်အထူးကို ခံယူထိုက်တော်မူထိုက်သော မြတ်စွာဘုရား။"],
        ["သမ္မာသမ္ဗုဒ္ဓေါ","တရားအလုံးစုံကို သဗ္ဗညုတဉာဏ်ဖြင့် အလိုလိုသိခြင်း၊ ဉာဏ်ပညာအကြီးဆုံးပုဂ္ဂိုလ်ဖြစ်တော်မူသော မြတ်စွာဘုရား။"],
        ["ဝိဇ္ဇာစရဏ သမ္ပန္နော","ဝိဇ္ဇာဉာဏ် ၃ ပါး (၈ပါး) ၊ စရဏ အကျင့် ၁၅ ပါးတို့နှင့် ပြည့်စုံတော်မူခြင်း၊ အကြီးဆုံး ဝိဇ္ဇာနှင့် အကောင်းဆုံး အကျင့်ရှိသူဖြစ်တော်မူသော မြတ်စွာဘုရား။"],
        ["သုဂတော","အကျိုးရှိသော ဟုတ်မှန်သောစကားကိုသာ ကောင်းစွာဆိုတတ်သောမြတ်စွာဘုရား။"],
        ["လောကဝိဒူ","သတ္တလောက၊ သင်္ခါရလောက၊ ဩကာသလောက တည်းဟူသော လောကသုံးပါးကို အကုန်အစင်သိမြင်တော်မူသော မြတ်စွာဘုရား။"],
        ["အနုတ္တရော ပုရိသ ဒမ္မသာရထိ","အတုမရှိ မြတ်တော်မူသည်ဖြစ်၍ မယဉ်ကျေးသောသူတို့ကို ယဉ်ကျေးအောင် ဆုံးမတော်မူတတ်သော မြတ်စွာဘုရား။"],
        ["သတ္တာ ဒေဝ မနုဿာနံ","လူ၊ နတ်၊ ဗြဟ္မာ သတ္တဝါအားလုံးတို့၏ ဆရာတစ်ဆူဖြစ်တော်မူသော မြတ်စွာဘုရား။"],
        ["ဗုဒ္ဓေါ","သစ္စာလေးပါးကို ကိုယ်ပိုင်ဉာဏ်ဖြင့် သိတော်မူပြီး တစ်ပါးသူတို့အားလည်း ဟောကြားညွှန်ပြနိုင်သောမြတ်စွာဘုရား။"],
        ["ဘဂဝါ","ဘုန်းတော် ၆-ပါးနှင့် ပြည့်စုံတော်မူခြင်း၊ ဘုန်းတန်ခိုးအကြီးဆုံးပုဂ္ဂိုလ်ဖြစ်သော မြတ်စွာဘုရား။"]
    ];

    // loop ပတ်နေရင်း မြန်မာလိုမြင်ချင်လို့ မြန်မာဂဏန်းတွေခေါ်လို့လွယ်အောင် array ထဲ အစဉ်လိုက်ထည့်
    $MMNums = ['၀', '၁', '၂', '၃', '၄', '၅', '၆', '၇', '၈', '၉'];
    $Cycles = [
        [2,9,4,7,5,3,6,1,8],
        [3,1,5,8,6,4,7,2,9],
        [4,2,6,9,7,5,8,3,1],
        [5,3,7,1,8,6,9,4,2],
        [6,4,8,2,9,7,1,5,3],
        [7,5,9,3,1,8,2,6,4],
        [8,6,1,4,2,9,3,7,5],
        [9,7,2,5,3,1,4,8,6],
        [1,8,3,6,4,2,5,9,7]
    ];

    $MiniTable = "<table id='MiniTable' class='table'><tbody>
        <tr><td>
            <u> ယနေ့ </u>
            <br>". date("j F Y (l)", $Today);

    $MainTable = "<table id='MainTable' class='table'><tbody>
            <tr> <td colspan=4> 
                အစနေ့ - ". date("j F Y (l)", $StartDate) ."
                <br> <span class='bright-font-green'>  ယနေ့ - ". date("j F Y (l)", $Today) ."</span>
                <br> အောင်မြင်မည့်နေ့ - ". date("j F Y (l)", $DeterminationEndDate) . "
                <br> အစိမ်းရောင်ချယ်ထားသောနေ့များမှာ သက်သတ်လွတ် စားရပါမည်။ 
            </tr>
            <tr id='LL_table_header' class='table_header'>
                <th> နေ့စွဲ </th><th> ဂုဏ်တော် </th><th> အဆင့် </th>
            </tr>
    ";

    $TodayLevel = "<br>";
    $TodayCycleCount = "<u> ယနေ့ ပုတီးပတ် </u>";
    $TomorrowCycleCount = "<u> မနက်ဖြန် ပုတီးပတ် </u>";
    $VegetarianRow = "<u> လာမည့် သက်သတ်လွတ်နေ့ </u>";
    $VegetarianRowSpecialNote = "";
    $NoMoreVegetarianDays = strtotime('5 day',$Today) > $DeterminationEndDate;
    $TodayCycleMeaning = "";
    for ($i = 0; $i < 81; ++$i){
        $DisplayDate = strtotime("$i day", $StartDate);
        $MainTableRow = "";
        $MainTableRow .= "<tr";
        if ((int)$i%9 == 4) {
            if ($DisplayDate == $Today) {$MainTableRow .= " class='highlight-green bright-font-orange'";}
            else {$MainTableRow .= " class='highlight-green'";}

            if (($Today < $DisplayDate) && ((strtotime('9 days',$Today) >= $DisplayDate))) {$VegetarianRow .= "<br>". date("j F Y (l)",$DisplayDate);}
            if ($Today == $DisplayDate) {
                $VegetarianRowSpecialNote .= "<br><span class='bright-font-green'> ယနေ့ သက်သတ်လွတ်စားရန်။ </span><br>";
                if ($NoMoreVegetarianDays) {$VegetarianRowSpecialNote .= "<br><span class='bright-font-green'> ယနေ့ပြီးလျှင် သက်သတ်လွတ်စားရန် မလိုတော့ပါ။ </span><br>";}
            }
            elseif ($Tomorrow == $DisplayDate) {
                $VegetarianRow .= "<br><span class='bright-font-green'> မနက်ဖြန် သက်သတ်လွတ်စားရန်။ </span><br>";
                if ($NoMoreVegetarianDays || (strtotime('6 day',$Today) > $DeterminationEndDate)) {$VegetarianRow .= "<span class='bright-font-green'> မနက်ဖြန်ပြီးလျှင် သက်သတ်လွတ်စားရန် မလိုတော့ပါ။ </span><br>";}
            }
        }

        // Debug
        // echo "today:". $Today . " | display:". $DisplayDate . " | tomorrow:". $Tomorrow . " <br> ";
        if ($DisplayDate == $Today) {
            $MainTableRow .= " class='bright-font-orange'";
            $TodayLevel .= "<span class='bright-font-orange'> အဆင့် " . $MMNums[(int)($i/9)+1] ." - ". $MMNums[(int)($i%9)+1] ." ရက် </span>";
            $TodayCycleCount .= "<br><span class='bright-font-orange bold-font larger-font'>". $GongDaw[$Cycles[(int)$i/9][(int)$i%9]][0] ." ". $MMNums[$Cycles[(int)$i/9][(int)$i%9]] ." ပတ် </span>";
            if ($Today == $DeterminationEndDate) {$TodayCycleCount .= "<br><span class='bright-font-green'> ယနေ့ပြီးလျှင် အဓိဋ္ဌာန်အောင်မြင်ပါပြီ။ </span>";}
            $TodayCycleMeaning = "<tr><td><i>". trim($GongDaw[$Cycles[(int)$i/9][(int)$i%9]][0]) ."</i><br>". $GongDaw[$Cycles[(int)$i/9][(int)$i%9]][1] ."</td></tr>";
        }
        
        if ($DisplayDate == $Tomorrow) {
            $TomorrowCycleCount .= "<br><span class='bright-font-orange'>" . $GongDaw[$Cycles[(int)$i/9][(int)$i%9]][0] ." ". $MMNums[$Cycles[(int)$i/9][(int)$i%9]] ." ပတ် </span>";
            if ($Tomorrow == $DeterminationEndDate) {$TomorrowCycleCount .= "<br><span class='bright-font-green'> မနက်ဖြန်ပြီးလျှင် အဓိဋ္ဌာန်အောင်မြင်ပါပြီ။ </span>";}
        }

        $MainTableRow .= ">";
        $MainTableRow .= "<td id='date-" . ($i+1) . "'>". date("j F Y (l)",$DisplayDate) ."</td>";
        $MainTableRow .= "<td>". $GongDaw[$Cycles[(int)$i/9][(int)$i%9]][0] ." ". $MMNums[$Cycles[(int)$i/9][(int)$i%9]] ." ပတ် </td>";
        $MainTableRow .= "<td> အဆင့် " . $MMNums[(int)($i/9)+1] ." - ". $MMNums[(int)($i%9)+1] ." ရက်</td>";
        $MainTableRow .= "</tr>";
        
        $MainTable .= $MainTableRow;
        if ((int)$i/9 > 0 && (int)$i/9 < 8 && (int)$i%9 == 8) {$MainTable .= "<tr class='table-break'><td colspan=4></td></tr>";}
    }
    
    if ($Today > $DeterminationEndDate) {$TodayCycleCount .= "<br><span class='bright-font-green'> အဓိဋ္ဌာန်အောင်မြင်ပါပြီ။ </span>";}
    if ($Today == $DeterminationEndDate) {$TomorrowCycleCount .= "<br><span class='bright-font-green'> ယနေ့ပြီးလျှင် အဓိဋ္ဌာန်အောင်မြင်ပါပြီ။ </span>";}
    elseif ($Tomorrow > $DeterminationEndDate) {$TomorrowCycleCount .= "<br><span class='bright-font-green'> အဓိဋ္ဌာန်အောင်မြင်ပါပြီ။ </span>";}
    if (strlen($VegetarianRow) == 0){$VegetarianRow .= "<u> လာမည့် သက်သတ်လွတ်နေ့ </u><br><span class='bright-font-green'> သက်သတ်လွတ်စားရန် မလိုတော့ပါ။ </span><br>";}

    $MiniTable .= $TodayLevel . "<br><br>";
    $MiniTable .= $TodayCycleCount . "<br><br>";
    $MiniTable .= $TomorrowCycleCount . "<br><br>";
    if (strlen($VegetarianRowSpecialNote) > 0){$VegetarianRow .= $VegetarianRowSpecialNote;}
    $MiniTable .= $VegetarianRow;
    $MiniTable .= $TodayCycleMeaning;
    $MiniTable .= "</td></tr></tbody></table>";
    $MainTable .= "</tbody></table>";
?>

<html>
<head>
    <title>၉ နဝင်း</title>
    <style>
        body {
            font-family: "TharLon", "Arial";
            font-size: auto;
            background-color: black;
            color: antiquewhite;
        }
        button {
            background-color: black;
            color: antiquewhite;
            font-family: inherit;
            font-size: inherit;
            border: 1px solid;
            margin-bottom: 5px;
            padding: 10px;
        }
        button:hover {
            background-color: antiquewhite;
            color: black;
            cursor: pointer;
        }
        .section_title {
            padding: 5px;
            text-align: center;
            width: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            font-size: inherit;
            border: 1px solid antiquewhite;
            padding: 1em;
            text-align: center;
        }
        .table-break {
            height: 5px;
        }
        .highlight-green {
            background-color: green;
        }
        .bold-font {
            font-weight: bold;
        }
        .larger-font {
            font-size: larger;
        }
        .bright-font-yellow {
            color: yellow;
        }
        .bright-font-red {
            color: red;
        }
        .bright-font-orange {
            color: orange;
        }
        .bright-font-green {
            color: lime;
        }

        @media only screen and (max-width: 980px) {
            body {
                font-size: 2rem;
            }
            #MiniTable {
                width: 100%;
                font-size: 3rem;
            }
            #MainTable {
                width: 100%;
                font-size: auto;
            }
        }

    </style>
</head>
<body>
    <div>
        <a href="/"> <button> Back to Home </button> </a>
    </div>
    <h2 id="LL_title" class="section_title"> ဟိန်းထက်ဇော် <br> ကိုးနဝင်း အဓိဋ္ဌာန် ဇယား </h2>
    <?php echo $MiniTable ?>
    <br>
    <?php echo $MainTable ?>
</body>
</html>