<?php
define('API_KEY',"1654130041:AAHPKMMfEwAiD5zcSxvF3euLVxObRdFC2h0");
$admin = "1337486313"; // admin idsi
function put($fayl,$nima){
file_put_contents("$fayl","$nima");
}
function get($fayl){
$get = file_get_contents("$fayl");
return $get;
}
function ty($ch){ 
return bot('sendChatAction', [
'chat_id' => $ch,
'action' => 'typing',
]);
}
function editMessageText(
        $chatId,
        $messageId,
        $text,
        $parseMode = null,
        $disablePreview = false,
        $replyMarkup = null,
        $inlineMessageId = null
    ) {
       return bot('editMessageText', [
            'chat_id' => $chatId,
            'message_id' => $messageId,
            'text' => $text,
            'inline_message_id' => $inlineMessageId,
            'parse_mode' => $parseMode,
            'disable_web_page_preview' => $disablePreview,
            'reply_markup' => $replyMarkup,
        ]);
    }
function ACL($callbackQueryId, $text = null, $showAlert = false)
{
     return bot('answerCallbackQuery', [
        'callback_query_id' => $callbackQueryId,
        'text' => $text,
        'show_alert'=>$showAlert,
    ]);
}
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;

$cid = $message->chat->id;
$cidtyp = $message->chat->type;
$miid = $message->message_id;
$tx = $message->text;
$callback = $update->callback_query;
$mmid = $callback->inline_message_id;
$mes = $callback->message;
$mid = $mes->message_id;
$cmtx = $mes->text;
$mmid = $callback->inline_message_id;
$idd = $callback->message->chat->id;
$cbid = $callback->from->id;
$data = $callback->data;
$ida = $callback->id;
$cqid = $update->callback_query->id;
$step = file_get_contents("click/$cid.step");
mkdir("click");
$banan = file_get_contents("click.ban");
$qadam = file_get_contents("abroriy/$cid.step");
mkdir("abroriy");
$qadam2 = file_get_contents("abror/$cid.step");
mkdir("abror");
$qadam3 = file_get_contents("payer/$cid.step");
mkdir("payer");
$qadam4 = file_get_contents("WMR/$cid.step");
mkdir("WMR");
$qadam5 = file_get_contents("sWMR/$cid.step");
mkdir("sWMR");
$banan = file_get_contents("abroriy.ban");



if((mb_stripos($banan,$cid)!==false) and isset($update)){
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"*BAN bilan tabriklayman, endi siz bandan chiqmaysiz!*",
'parse_mode'=>"markdown",
]);
}else{
$buton = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🔄Almashtirish"],['text'=>"🕐Ish vaqti"],],
[['text'=>"📊Komissiya"],['text'=>"👨‍💻Dasturchi"],],
[['text'=>"💬Biz bilan aloqa"],['text'=>"📊Kurs"],],
]
]);

$tanlash = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"QiWi ➡️ Sum"],['text'=>"Sum ➡️ QiWi"],],
[['text'=>"Payeer ➡️ Sum"],['text'=>"Sum ➡️ Payeer"],],
[['text'=>"Payeer ➡️ Qiwi"],['text'=>"Qiwi ➡ Payer"],],
[['text'=>"🔙Bosh menu"],],
]
]);

$bekor = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"🔙Bosh menu"],],
]
]);

$but = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"✅Tekshirish"],],
[['text'=>"🔙Bosh menu"],],
]
]);

if($tx == "🗑Avto o'chirish"){
ty($cid);
file_put_contents("coment/$cid.stp","off soat");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*⏲Kanaldagi postni o'chirish soatini belgilang.\n❗️Faqat postni o'chirish uchun, bot admin bo'lsa o'sha postni o'chirib tashlaydi*",
'reply_markup'=>$soat,
'parse_mode'=>"markdown",
]);
}

if(mb_stripos($tx,"/start")!==false){
ty($cid);
$baza = get("click.dat");
if(mb_stripos($baza, $cid) !== false){ 
}else{
put("click.dat", $baza+1);
}
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"😊Salom - *Rubl 🔁 Sum* tizimiga xush kelibsiz!
Bu tizim orqali o'z QiWi hisob raqamidagi pullarni Click(UzCard) raqamiga yoki Click(UzCard) raqamidagi pullarni QiWi hisob raqamiga o'tkazishingiz mumkin!",
'parse_mode'=>"markdown",
'reply_to_message_id'=>$miid,
'reply_markup'=>$buton,
]);
}

if($tx == "🔄Almashtirish"){
bot('sendmessage',[
'chat_id'=>$cid,
'reply_markup'=>$tanlash,
'text'=>"Sizga Kerakli Bo'limni Tanlang:
",
'parse_mode'=>"markdown",
]);
}

if($tx == "QiWi ➡️ Sum"){
put("click/$cid.step","change");
bot('sendmessage',[
'chat_id'=>$cid,
'reply_markup'=>$bekor,
'text'=>"Sotiladigan rubl miqdorini kiriting *Eng Kami 40 Rubl, Ko'pi 5000*:
",
'parse_mode'=>"markdown",
]);
}
if($step == "change"){
if($tx == "🔙Bosh menu"){
}else{
if($tx <= 5000 and $tx >= 40){
put("click/$cid.tmp","$tx");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*💳Click raqamingizni kiriting*",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
put("click/$cid.step","click");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"Sotiladigan rubl miqdorini kiriting
*Eng Kami 40 Rubl, Ko'pi 5000:*",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
}
}
}
if($step == "click"){
if($tx == "🔙Bosh menu"){
}else{
$str = strlen($tx);
$str1 = strlen("8600050486838883");
if($str == $str1){
put("click/$cid.tmp2","$tx");
$tmp = file_get_contents("click/$cid.tmp");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*✅Click raqami qabul qilindi.*
Endi `998995526267` shu QiWi hisob raqamiga *$tmp* rubl pulni o'tkazing va tekshirish tugmasini bosing
*Kommentariyga $cid deb yozishni unutmang*
☝️Agarda pulni o'tkazmasdan tekshirishni bossangiz *ban* beriladi.",
'parse_mode'=>"markdown",
'reply_markup'=>$but,
]);
unlink("click/$cid.step");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*💳Click raqamingizni orasida uzulishlarsiz kiriting*",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
}
}
}if($tx == "✅Tekshirish"){
$get = file_get_contents("click/$cid.tmp");
$get2 = file_get_contents("click/$cid.tmp2");
if($get and $get2){
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"⏩ *QiWi* Kashalogdan *Click*ga
💳: Hisob Raqam: `$get2`
💸: Summa: `$get Rubl`
/ok\_$cid\_$get
/no\_$cid\_$get",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode(
['inline_keyboard' => [
[['callback_data' => "/ban_".$cid, 'text' => "BAN"],],
]
]),
]);
unlink("click/$cid.tmp");
unlink("click/$cid.tmp2");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"☑️Buyurtmangiz ko'pi bilan *5* daqiqa ichida amalga oshiriladi.
Itimos sabr qiling, biz hech kimni aldamaymiz!",
'parse_mode'=>"markdown",
'reply_markup'=>$buton,
]);
}
}
if($tx == "🔙Bosh menu"){
bot('sendmessage',[
'chat_id'=>$cid,

'parse_mode'=>"markdown",
'reply_markup'=>$buton,
]);


unlink("click/$cid.step");
unlink("click/$cid.tmp");
unlink("click/$cid.tmp2");
}



if($tx == "Sum ➡️ QiWi"){
put("abroriy/$cid.step","qitmirvoy");
bot('sendmessage',[
'chat_id'=>$cid,
'reply_markup'=>$bekor,
'text'=>"Sizga kerakli rubl miqdorini kiriting *Eng Kami 40 Rubl, Ko'pi 5000*:
",
'parse_mode'=>"markdown",
]);
}
if($qadam == "qitmirvoy"){
if($tx == "🔙Bosh menu"){
}else{
if($tx <= 5000 and $tx >= 40){
put("abroriy/$cid.tmp","$tx");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*💳QiWi hisob raqamingizni kiriting*",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
put("abroriy/$cid.step","abroriy");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"Sizga kerakli rubl miqdorini kiriting
*Eng Kami 40 Rubl, Ko'pi 5000:*",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
}
}
}
if($qadam == "abroriy"){
if($tx == "🔙Bosh menu"){
}else{
$str = strlen($tx);
$str1 = strlen("8600050486838883");
if($str <= 20 and $str >= 9){
put("abroriy/$cid.tmp2","$tx");
$tmp = file_get_contents("abroriy/$cid.tmp");
$summa=$tmp*150;
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*✅QiWi hisob raqami qabul qilindi.*
Endi Uzcard: `8600042317191228` Humo: `9860030194521891` shu Click raqamlaridan biriga *$summa Sum* pulni o'tkazing va tekshirish tugmasini bosing.
☝️Agarda pulni o'tkazmasdan tekshirishni bossangiz *ban* beriladi.",
'parse_mode'=>"markdown",
'reply_markup'=>$but,
]);
unlink("abroriy/$cid.step");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*💳QiWi hisob raqamingizni orasida uzulishlarsiz kiriting*",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
}
}
}if($tx == "✅Tekshirish"){
$get = file_get_contents("abroriy/$cid.tmp");
$get2 = file_get_contents("abroriy/$cid.tmp2");
if($get and $get2){
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"⏩ *Click*dan *QiWi*ga
💳 Hisob Raqam: `$get2`
💸 Summa: `$get Rubl`
/ok\_$cid\_$get
/no\_$cid\_$get",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode(
['inline_keyboard' => [
[['callback_data' => "/ban_".$cid, 'text' => "BAN"],],
]
]),
]);
unlink("abroriy/$cid.tmp");
unlink("abroriy/$cid.tmp2");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"☑️Buyurtmangiz ko'pi bilan *30* daqiqa ichida amalga oshiriladi.
Itimos sabr qiling, biz xech kimni aldamaymiz!",
'parse_mode'=>"markdown",
'reply_markup'=>$buton,
]);
}
}
if($tx == "Sum ➡️ Payeer"){
put("abror/$cid.step","qitmir");
bot('sendmessage',[
'chat_id'=>$cid,
'reply_markup'=>$bekor,
'text'=>"Sizga kerakli rubl miqdorini kiriting *Eng Kami 40 Rubl, Ko'pi 5000*:
",
'parse_mode'=>"markdown",
]);
}
if($qadam2 == "qitmir"){
if($tx == "🔙Bosh menu"){
}else{
if($tx <= 5000 and $tx >= 40){
put("abror/$cid.tmp","$tx");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*💳Payeer hisob raqamingizni kiriting*",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
put("abror/$cid.step","abror");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"Sizga kerakli rubl miqdorini kiriting
*Eng Kami 40 Rubl, Ko'pi 5000:*",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
}
}
}
if($qadam2 == "abror"){
if($tx == "🔙Bosh menu"){
}else{
$str = strlen($tx);
$str1 = strlen("8600050486838883");
if($str <= 20 and $str >= 9){
put("abror/$cid.tmp2","$tx");
$tmp = file_get_contents("abror/$cid.tmp");
$summa=$tmp*150;
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*✅Payeer hisob raqami qabul qilindi.*
Endi Uzcard : `8600042317191228` Humo: `9860030194521891` shu Click raqamlaridan biriga *$summa Sum* pulni o'tkazing va tekshirish tugmasini bosing.
☝️Agarda pulni o'tkazmasdan tekshirishni bossangiz *ban* beriladi.",
'parse_mode'=>"markdown",
'reply_markup'=>$but,
]);
unlink("abror/$cid.step");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*💳Payeer hisob raqamingizni orasida uzulishlarsiz kiriting*",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
}
}
}if($tx == "✅Tekshirish"){
$get = file_get_contents("abror/$cid.tmp");
$get2 = file_get_contents("abror/$cid.tmp2");
if($get and $get2){
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"⏩ *Click*dan *PAYEER*ga
💳 Hisob Raqam: `$get2`
💸 Summa: `$get Rubl`
/ok\_$cid\_$get
/no\_$cid\_$get",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode(
['inline_keyboard' => [
[['callback_data' => "/ban_".$cid, 'text' => "BAN"],],
]
]),
]);
unlink("abror/$cid.tmp");
unlink("abror/$cid.tmp2");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"☑️Buyurtmangiz ko'pi bilan *30* daqiqa ichida amalga oshiriladi.
Itimos sabr qiling, biz xech kimni aldamaymiz!",
'parse_mode'=>"markdown",
'reply_markup'=>$buton,
]);
}
}


if($tx == "Payeer ➡️ Sum"){
put("payer/$cid.step","payera");
bot('sendmessage',[
'chat_id'=>$cid,
'reply_markup'=>$bekor,
'text'=>"Sotiladigan rubl miqdorini kiriting *Eng Kami 40 Rubl, Ko'pi 5000*:
",
'parse_mode'=>"markdown",
]);
}
if($qadam3 == "payera"){
if($tx == "🔙Bosh menu"){
}else{
if($tx <= 5000 and $tx >= 40){
put("payer/$cid.tmp","$tx");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*💳Click raqamingizni kiriting*",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
put("payer/$cid.step","payer");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"Sotiladigan rubl miqdorini kiriting
*Eng Kami 40 Rubl, Ko'pi 5000:*",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
}
}
}
if($qadam3 == "payer"){
if($tx == "🔙Bosh menu"){
}else{
$str = strlen($tx);
$str1 = strlen("8600050486838883");
if($str == $str1){
put("payer/$cid.tmp2","$tx");
$tmp = file_get_contents("payer/$cid.tmp");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*✅Click raqami qabul qilindi.*
Endi `P1055450020` shu PAYEER hisob raqamiga *$tmp* rubl pulni o'tkazing va tekshirish tugmasini bosing
*Kommentariyga $cid deb yozishni unutmang*
☝️Agarda pulni o'tkazmasdan tekshirishni bossangiz *ban* beriladi.",
'parse_mode'=>"markdown",
'reply_markup'=>$but,
]);
unlink("payer/$cid.step");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*💳Click raqamingizni orasida uzulishlarsiz kiriting*",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
}
}
}if($tx == "✅Tekshirish"){
$get = file_get_contents("payer/$cid.tmp");
$get2 = file_get_contents("payer/$cid.tmp2");
if($get and $get2){
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"⏩ *PAYEER* Kashalogdan *Click*ga
💳: Hisob Raqam: `$get2`
💸: Summa: `$get Rubl`
/ok\_$cid\_$get
/no\_$cid\_$get",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode(
['inline_keyboard' => [
[['callback_data' => "/ban_".$cid, 'text' => "BAN"],],
]
]),
]);
unlink("payer/$cid.tmp");
unlink("payer/$cid.tmp2");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"☑️Buyurtmangiz ko'pi bilan *5* daqiqa ichida amalga oshiriladi.
Itimos sabr qiling, biz hech kimni aldamaymiz!",
'parse_mode'=>"markdown",
'reply_markup'=>$buton,
]);
}
}

if($tx == "🔙Bosh menu"){
bot('sendmessage',[
'chat_id'=>$cid,

'parse_mode'=>"markdown",
'reply_markup'=>$buton,
]);
unlink("payer/$cid.step");
unlink("payer/$cid.tmp");
unlink("payer/$cid.tmp2");
}


if($tx == "Payeer ➡️ Qiwi"){
put("WMR/$cid.step","WMRa");
bot('sendmessage',[
'chat_id'=>$cid,
'reply_markup'=>$bekor,
'text'=>"Sotiladigan rubl miqdorini kiriting *Eng Kami 40 Rubl, Ko'pi 5000*:
",
'parse_mode'=>"markdown",
]);
}
if($qadam4 == "WMRa"){
if($tx == "🔙Bosh menu"){
}else{
if($tx <= 5000 and $tx >= 40){
put("WMR/$cid.tmp","$tx");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*💳Qiwi raqamingizni kiriting*",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
put("WMR/$cid.step","WMR");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"Sotiladigan rubl miqdorini kiriting
*Eng Kami 40 Rubl, Ko'pi 5000:*",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
}
}
}
if($qadam4 == "WMR"){
if($tx == "🔙Bosh menu"){
}else{
$str = strlen($tx);
$str1 = strlen("+998938771410");
if($str == $str1){
put("WMR/$cid.tmp2","$tx");
$tmp = file_get_contents("WMR/$cid.tmp");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*✅Qiwi raqami qabul qilindi.*
Endi `P1055450020` shu Payeer hisob raqamiga *$tmp* rubl pulni o'tkazing va tekshirish tugmasini bosing
*Kommentariyga $cid deb yozishni unutmang*
☝️Agarda pulni o'tkazmasdan tekshirishni bossangiz *ban* beriladi.",
'parse_mode'=>"markdown",
'reply_markup'=>$but,
]);
unlink("WMR/$cid.step");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*💳Qiwi raqamingizni xatosiz kiriting*",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
}
}
}if($tx == "✅Tekshirish"){
$get = file_get_contents("WMR/$cid.tmp");
$get2 = file_get_contents("WMR/$cid.tmp2");
if($get and $get2){
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"⏩ *Payeer* Kashalogdan *Qiwi*ga
💳: Hisob Raqam: `$get2`
💸: Summa: `$get Rubl`
/ok\_$cid\_$get
/no\_$cid\_$get",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode(
['inline_keyboard' => [
[['callback_data' => "/ban_".$cid, 'text' => "BAN"],],
]
]),
]);
unlink("WMR/$cid.tmp");
unlink("WMR/$cid.tmp2");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"☑️Buyurtmangiz ko'pi bilan *5* daqiqa ichida amalga oshiriladi.
Itimos sabr qiling, biz hech kimni aldamaymiz!",
'parse_mode'=>"markdown",
'reply_markup'=>$buton,
]);
}
}
if($tx == "🔙Bosh menu"){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*Bosh Menu*",
'parse_mode'=>"markdown",
'reply_markup'=>$buton,
]);
unlink("WMR/$cid.step");
unlink("WMR/$cid.tmp");
unlink("WMR/$cid.tmp2");
}




if($tx == "Qiwi ➡ Payer"){
put("sWMR/$cid.step","sWMRs");
bot('sendmessage',[
'chat_id'=>$cid,
'reply_markup'=>$bekor,
'text'=>"Sizga kerakli rubl miqdorini kiriting *Eng Kami 40 Rubl, Ko'pi 5000*:
",
'parse_mode'=>"markdown",
]);
}
if($qadam5 == "sWMRs"){
if($tx == "🔙Bosh menu"){
}else{
if($tx <= 5000 and $tx >= 40){
put("sWMR/$cid.tmp","$tx");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*Payer hisob raqamingizni kiriting*",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
put("sWMR/$cid.step","sWMR");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"Sizga kerakli rubl miqdorini kiriting
*Eng Kami 40 Rubl, Ko'pi 5000:*",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
}
}
}
if($qadam5 == "sWMR"){
if($tx == "🔙Bosh menu"){
}else{
$str = strlen($tx);
$str1 = strlen("8600050486838883");
if($str <= 20 and $str >= 9){
put("sWMR/$cid.tmp2","$tx");
$tmp = file_get_contents("sWMR/$cid.tmp");
$summa=$tmp*140;
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*✅Payeer hisob raqami qabul qilindi.*
Endi `+998995526267` shu Qiwi raqamiga *$tmp Rubl* pulni o'tkazing va tekshirish tugmasini bosing.
☝️Agarda pulni o'tkazmasdan tekshirishni bossangiz *ban* beriladi.",
'parse_mode'=>"markdown",
'reply_markup'=>$but,
]);
unlink("sWMR/$cid.step");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*💳Payeer hisob raqamingizni orasida uzulishlarsiz kiriting*",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
}
}
}if($tx == "✅Tekshirish"){
$get = file_get_contents("sWMR/$cid.tmp");
$get2 = file_get_contents("sWMR/$cid.tmp2");
if($get and $get2){
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"⏩ *Qiwi*dan *Payeer*ga
💳 Hisob Raqam: `$get2`
💸 Summa: `$get Rubl`
/ok\_$cid\_$get
/no\_$cid\_$get",
'parse_mode'=>"markdown",
'reply_markup'=>json_encode(
['inline_keyboard' => [
[['callback_data' => "/ban_".$cid, 'text' => "BAN"],],
]
]),
]);
unlink("sWMR/$cid.tmp");
unlink("sWMR/$cid.tmp2");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"☑️Buyurtmangiz ko'pi bilan *30* daqiqa ichida amalga oshiriladi.
Itimos sabr qiling, biz xech kimni aldamaymiz!",
'parse_mode'=>"markdown",
'reply_markup'=>$buton,
]);
}
}



if($tx == "🕐Ish vaqti"){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"Ish vaqti:

*06:00 dan 20:00 gacha*",
'parse_mode'=>"markdown",
'reply_markup'=>$buton,
]);
}

if($tx == "👨‍💻Dasturchi"){
bot('sendphoto',[
'chat_id'=>$cid,
'photo'=>"https://t.me/Alien_apk/70",

'caption'=>"*🔊Yaratuvchi: @The_alien_warrior*",
'parse_mode'=>"markdown",
'reply_markup'=>$buton,
]);
}

if($tx == "📊Komissiya"){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"📊 Комиссия обмена

▫️ Payeer на QIWI: 2.00%
▫️ QIWI на Payeer: 2.00%
▫️ QIWI на UZCARD: 3.00%
▫️ UZCARD на QIWI: 3.00%
▫️ Payeer на UZCARD: 3.00%
▫️ UZCARD на Payeer: 3.00%",
'parse_mode'=>"markdown",
'reply_markup'=>$buton,
]);
}


if($tx == "📊Kurs"){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*📊Kurs:

📉Sotamiz
1 QIWI RUB = 150 UZS
1 PAYEER RUB = 150 UZS



📉Sotib Olamiz
1 QIWI RUB = 145 UZS
1 PAYEER RUB = 145 UZS
*",
'parse_mode'=>"markdown",
'reply_markup'=>$buton,
]);
}
////////
if($tx == "💬Biz bilan aloqa"){
put("click/$cid.step","savol");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"💬Bizga savoliz bo'lsa yozing!",
'parse_mode'=>"markdown",
'reply_markup'=>$bekor,
]);
}

if($step == "savol"){
if($tx == "🔙Bosh menu"){}
else{
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"$tx\n\n/reply_".$cid."_matn",
]);
unlink("click/$cid.step");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"*Habaringizga tez orada javob olasiz!*",
'parse_mode'=>"markdown",
'reply_markup'=>$buton,
]);
}
}

if(mb_stripos($tx,"/reply")!==false){
$ex = explode("_",$tx);
$res = bot('sendmessage',[
'chat_id'=>$ex[1],
'text'=>$ex[2],
]);
if($res->ok){
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"Yuborildi!",
]);
}else{
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"Yuborilmadi!",
]);
}
}

if((mb_stripos($tx,"/no")!==false) and $cid == $admin){
$ex = explode("_",$tx);
$idi = $ex[1];
$sum = $ex[2];
$res = bot('sendmessage',[
'chat_id'=>$idi,
'text'=>"💢Sizning buyurtmangiz bajarilmadi. Sababi to'lov amalga oshirilmagan.",
]);
if($res->ok){
bot('sendmessage',[
'chat_id'=>"@Izzoh_11",
'text'=>"❌Bajarilmadi!
👤Id: $idi
💸: $sum RUB",
]);
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"Yuborildi!",
]);
}else{
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"Yuborilmadi!",
]);
}
}

if((mb_stripos($tx,"/ok")!==false) and $cid == $admin){
$ex = explode("_",$tx);
$sum = $ex[2];
$idi = $ex[1];
$res = bot('sendmessage',[
'chat_id'=>$idi,
'text'=>"✅Sizning buyurtmangiz Bajarildi!
Barcha bajarilgan buyurtmalar @QiWi_Sum kanalida berib boriladi",
]);
bot('sendmessage',[
'chat_id'=>"@Izzoh_11",
'text'=>"✅Bajarildi!
👤 Ismi: $name
👤Id: $idi
💸: $sum RUB",
]);
if($res->ok){
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"Yuborildi!",
]);
}else{
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"Yuborilmadi!",
]);
}
}

if((mb_stripos($data,"/ban")!==false) and $cbid == $admin){
$ex = explode("_",$data);
$sum = $ex[2];
$idi = $ex[1];
$baza = get("click.ban");
put("click.ban", "$baza\n$idi");
$res = bot('sendmessage',[
'chat_id'=>$idi,
'text'=>"*BAN bilan tabriklayman, endi siz bandan chiqmaysiz!*",
'parse_mode'=>"markdown",
]);
if($res->ok){
bot('sendmessage',[
'chat_id'=>"@Izzoh_11",
'text'=>"❌BAN!
👤Id: $idi",
]);
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"Yuborildi!",
]);
}else{
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"Yuborilmadi!",
]);
}
}

if($tx == "/stat"){
$baza = get("click.dat");
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"$baza",
]);
}
}
?>
