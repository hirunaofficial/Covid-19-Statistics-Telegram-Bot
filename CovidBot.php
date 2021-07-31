<?php
$token = 'BOT_TOKEN';
$img = 'BOT_IMG';

$input = file_get_contents('php://input');
$update = json_decode($input);
$send = $update->message->text;
$chat_id = $update->message->chat->id;
$fname = $update->message->chat->first_name;
$lname = $update->message->chat->last_name;

$url = file_get_contents('https://www.hpb.health.gov.lk/api/get-current-statistical');
$coviddecode = json_decode($url);
$update = $coviddecode->data->update_date_time;
$lnew = $coviddecode->data->local_new_cases;
$ltotal = $coviddecode->data->local_total_cases;
$lactive = $coviddecode->data->local_active_cases;
$ldeaths = $coviddecode->data->local_deaths;
$lnewdeaths = $coviddecode->data->local_new_deaths;
$lrecovered = $coviddecode->data->local_recovered;
$lhospitals = $coviddecode->data->local_total_number_of_individuals_in_hospitals;
$gnew = $coviddecode->data->global_new_cases;
$gtotal = $coviddecode->data->global_total_cases;
$gdeaths = $coviddecode->data->global_deaths;
$gnewdeaths = $coviddecode->data->global_new_deaths;
$grecovered = $coviddecode->data->global_recovered;
$totalpcr = $coviddecode->data->total_pcr_testing_count;
$totalantigen = $coviddecode->data->total_antigen_testing_count;

$covidtext = urlencode("<b>\xF0\x9F\x92\x89 Sri Lanka Covid 19 Stats Bot \xF0\x9F\x92\x89\n(Date/Time - $update)</b>\n\n<b>\xf0\x9f\x87\xb1\xf0\x9f\x87\xb0 Local Covid 19 Stats Bot \xf0\x9f\x87\xb1\xf0\x9f\x87\xb0</b>\n\n\xF0\x9F\x93\x8A Total Confirmed Cases: $ltotal\n\xF0\x9F\x94\x96 Active Cases: $lactive\n\xF0\x9F\x98\xB7 Daily New Cases: $lnew\n\xF0\x9F\x8F\xA5 Individuals currently under investigations in hospitals: $lhospitals\n\xF0\x9F\x93\x9F	 Recovered & Discharged: $lrecovered\n\xF0\x9F\x92\xA5 Deaths: $ldeaths\n\xF0\x9F\x92\xA3 Daily New Deaths - $lnewdeaths\n\n\xF0\x9F\x93\xA9 Total PCR Testing Count - $totalpcr\n\xF0\x9F\x93\xAB Total Rapid Antigen Testing Count - $totalantigen\n\n<b>\xF0\x9F\x8C\x8E Globle Covid 19 Stats Bot \xF0\x9F\x8C\x8E</b>\n\n\xF0\x9F\x93\x8A Total Confirmed Cases: $gtotal\n\xF0\x9F\x98\xB7 Daily New Cases: $gnew\n\xF0\x9F\x93\x9F Recovered:$grecovered\n\xF0\x9F\x92\xA5 Totals Deaths: $gdeaths\n\xF0\x9F\x92\xA3 Daily New Deaths - $gnewdeaths");

$inlinebutton = array(
    "inline_keyboard" => array(array(array("text" => "\xE2\x9E\x95 Add me to Your Group", "url" => "https://t.me/ipstatisticsbot?startgroup=new")))
);

$keyboard = json_encode($inlinebutton, true);

if (strpos($send, "/start") === 0) {

$welcome = urlencode("<b>\xF0\x9F\x92\x89 Sri Lanka Covid 19 Stats Bot \xF0\x9F\x92\x89</b>\n\n\xF0\x9F\x91\x8B	Hey <b>$fname $lname</b> \xf0\x9f\x87\xb1\xf0\x9f\x87\xb0 I'm <b>Sri Lanka Covid 19 Stats Bot</b> \xF0\x9F\x92\xAA Type /covid or /corona to get all about <b>Covid 19</b> Informations \xF0\x9F\x92\xA1 Powerd by <b>Sri Lanka Health Promotion Bureau</b> \xF0\x9F\x92\x8A and Send /help to Get more Information About <b>Sri Lanka Covid 19 Stats Bot</b> \xE2\x9A\xA1\n\n<b>Developed by @hirunaofficial \xf0\x9f\x87\xb1\xf0\x9f\x87\xb0</b>");

file_get_contents("https://api.telegram.org/bot$token/sendphoto?chat_id=$chat_id&photo=$img&parse_mode=HTML&caption=$welcome&reply_markup=$keyboard");
}

if (strpos($send, "/help") === 0) {

$help = urlencode("<b>\xF0\x9F\x92\x89 Sri Lanka Covid 19 Stats Bot \xF0\x9F\x92\x89</b>\n\n\xE3\x80\xBD <b>About Bot</b> \xE3\x80\xBD\n\n<b>\xE2\x96\xB6	Name</b> - Sri Lanka Covid 19 Stats Bot\n<b>\xE2\x96\xB6	Username</b> - @srilankacovid19statsbot\n<b>\xE2\x96\xB6	Created By</b> - @hirunaofficial\n\n<b>\xF0\x9F\x94\xA7 Bot Commands \xF0\x9F\x94\xA7</b>\n\n\xE2\x96\xB6	/start - What is Sri Lanka Covid 19 Stats Bot\n\xE2\x96\xB6	/covid /corona - Get Local and Globle Covid 19 Informations\n\xE2\x96\xB6	/help - More information about Sri Lanka Covid 19 Stats Bot");

file_get_contents("https://api.telegram.org/bot$token/sendphoto?chat_id=$chat_id&photo=$img&parse_mode=HTML&caption=$help&reply_markup=$keyboard");
}

if (strpos($send, "/covid") === 0) {
file_get_contents("https://api.telegram.org/bot$token/sendphoto?chat_id=$chat_id&photo=$img&parse_mode=HTML&caption=$covidtext&reply_markup=$keyboard");
}

if (strpos($send, "/corona") === 0) {
file_get_contents("https://api.telegram.org/bot$token/sendphoto?chat_id=$chat_id&photo=$img&parse_mode=HTML&caption=$covidtext&reply_markup=$keyboard");
}
?>
