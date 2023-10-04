<style>
.main_box1 {
    position:relative;
}
.main_box1 img {
    position:absolute;
    width:100%;
    margin:0 auto;
}
.main_box2 {

}
.main_box2 img {
    position:absolute;
    width:100%;
    margin:0 auto;
}
.main_box3 {
    
}
.main_box3 img {
    width:100%;
    margin:0 auto;
}
</style>
<div class="main_box1">
    <img src="/img/tables/olleh_mobile_application_form_back_1.jpg">
    <span class="applicant">{{ $cell_phones[0]->cpb_applicant }}</span>
    <span class="applicant">{{ $cell_phones[0]->cpb_passportnumber }}</span>
    <span class="applicant">{{ $cell_phones[0]->cpb_gender }}</span>
    <span class="applicant">{{ $cell_phones[0]->email }}</span>
    <span class="applicant">{{ $cell_phones[0]->cpb_chooselastnumber }}</span>
</div>
<div class="main_box2">
    <img src="/img/tables/olleh_mobile_application_form_back_2.jpg">

</div>
<div class="main_box3">
    <img src="/img/tables/olleh_mobile_application_form_back_3.jpg">

</div>