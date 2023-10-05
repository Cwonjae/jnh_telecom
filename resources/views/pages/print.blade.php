<!DOCTYPE html>
<html>
    <head>
        <style type="text/css" media="print">
            html { padding: 0; margin: 0; overflow: scroll; width: 100%; height: 100%; }
            body { padding: 0; margin: 0; width: 100%; height: 100%;}
            .print_main_box { padding: 0; width: 100%; max-width: 100%; height: 100%; max-height: 100%; margin: 0 auto; text-align: center; }
            .main_box1 { width: inherit; height: inherit; max-height: 100%; overflow: scroll; }
            .img_box_1 {
                background-image: url("/img/tables/olleh_mobile_application_form_back_1.jpg");
                background-size: auto 100%;
                background-repeat: no-repeat;
                height: 100%;
                background-attachment: scroll;
                max-height: 100%;
                overflow: scroll;
                margin: 0 auto;
            }
            .img_box_1 span.applicant {
                position: absolute;
                top: 392px;
                left: 200px;
                font-size: 14px;
                z-index: 1;
            }
            .img_box_1 span.passportnumber {
                position: absolute;
                top: 392px;
                left: 500px;
                font-size: 14px;
                z-index: 1;
            }
        </style>
    </head>
    <body>
        <div class="print_main_box">
            <div class="main_box1">
                <div class="img_box_1">
                    <span class="applicant">{{ $cell_phones[0]->cpb_applicant }}</span>
                    <span class="passportnumber">{{ $cell_phones[0]->cpb_passportnumber }}</span>
                </div>
                <!-- 
                <span class="applicant">{{ $cell_phones[0]->cpb_passportnumber }}</span>
                <span class="applicant">{{ $cell_phones[0]->cpb_gender }}</span>
                <span class="applicant">{{ $cell_phones[0]->email }}</span>
                <span class="applicant">{{ $cell_phones[0]->cpb_chooselastnumber }}</span>
            </div> -->
        </div>
    </body>
</html>
<!-- <div class="main_box2">
    <img src="/img/tables/olleh_mobile_application_form_back_2.jpg">

</div>
<div class="main_box3">
    <img src="/img/tables/olleh_mobile_application_form_back_3.jpg">

</div> -->