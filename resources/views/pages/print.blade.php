<!DOCTYPE html>
<html>
    <head>
        <style type="text/css">
            @media print {
                #header{display: none;}
                #sidebar{display: none;}
                #footer{display: none;}   
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
                    left: 460px;
                    font-size: 14px;
                    z-index: 1;
                } 
                .img_box_1 span.gender_m {
                    position: absolute;
                    top: 390px;
                    left: 662px;
                    font-size: 14px;
                    font-style: oblique;
                    z-index: 1;
                }
                .img_box_1 span.gender_f {
                    position: absolute;
                    top: 390px;
                    left: 693px;
                    font-size: 14px;
                    font-style: oblique;
                    z-index: 1;
                }
                .img_box_1 span.email {
                    position: absolute;
                    top: 418px;
                    left: 540px;
                    font-size: 14px;
                    z-index: 1;
                }
                .img_box_1 span.chooselastnumber {
                    position: absolute;
                    top: 708px;
                    left: 358px;
                    font-size: 14px;
                    z-index: 1;
                }
                .img_box_1 img#signature_img {
                    position: absolute;
                    top: 1050px;
                    left: 530px;
                    font-size: 14px;
                    width: 150px;
                    height: 50px;
                    z-index: 1;
                }

                .main_box2 { width: inherit; height: inherit; max-height: 100%; overflow: scroll; page-break-before:always; }
                .img_box_2 {
                    background-image: url("/img/tables/olleh_mobile_application_form_back_2.jpg");
                    background-size: auto 100%;
                    background-repeat: no-repeat;
                    height: 100%;
                    background-attachment: scroll;
                    max-height: 100%;
                    overflow: scroll;
                    margin: 0 auto;
                }
                .img_box_2 img#signature_img {
                    position: absolute;
                    top: 1050px;
                    left: 530px;
                    font-size: 14px;
                    width: 150px;
                    height: 50px;
                    z-index: 1;
                }
            }
            
            @media screen {
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
                    top: 324px;
                    left: 170px;
                    font-size: 14px;
                    z-index: 1;
                }
                .img_box_1 span.passportnumber {
                    position: absolute;
                    top: 324px;
                    left: 380px;
                    font-size: 14px;
                    z-index: 1;
                }
                .img_box_1 span.gender_m {
                    position: absolute;
                    top: 321px;
                    left: 549px;
                    font-size: 14px;
                    font-style: oblique;
                    z-index: 1;
                }
                .img_box_1 span.gender_f {
                    position: absolute;
                    top: 321px;
                    left: 575px;
                    font-size: 14px;
                    font-style: oblique;
                    z-index: 1;
                }
                .img_box_1 span.email {
                    position: absolute;
                    top: 344px;
                    left: 450px;
                    font-size: 14px;
                    z-index: 1;
                }
                .img_box_1 span.chooselastnumber {
                    position: absolute;
                    top: 584px;
                    left: 286px;
                    font-size: 14px;
                    z-index: 1;
                }
                .img_box_1 img#signature_img {
                    position: absolute;
                    top: 866px;
                    left: 428px;
                    font-size: 14px;
                    width: 150px;
                    height: 50px;
                    z-index: 1;
                }
                
                .main_box2 { width: inherit; height: inherit; max-height: 100%; overflow: scroll; page-break-before:always; }
                .img_box_2 {
                    background-image: url("/img/tables/olleh_mobile_application_form_back_2.jpg");
                    background-size: auto 100%;
                    background-repeat: no-repeat;
                    height: 100%;
                    background-attachment: scroll;
                    max-height: 100%;
                    overflow: scroll;
                    margin: 0 auto;
                }
                .img_box_2 img#signature_img {
                    position: absolute;
                    top: 866px;
                    left: 428px;
                    font-size: 14px;
                    width: 150px;
                    height: 50px;
                    z-index: 1;
                }
            }
        </style>
    </head>
    <body>
        <div class="print_main_box">
            <div class="main_box1">
                <div class="img_box_1">
                    <span class="applicant">{{ $cell_phones[0]->cpb_applicant }}</span>
                    <span class="passportnumber">{{ $cell_phones[0]->cpb_passportnumber }}</span>
                    @if($cell_phones[0]->cpb_gender == "male")
                        <span class="gender_m">v</span>
                    @else
                        <span class="gender_f">v</span>
                    @endif
                    <span class="email">{{ $cell_phones[0]->email }}</span>
                    <span class="chooselastnumber">{{ $cell_phones[0]->cpb_chooselastnumber }}</span>
                    @if($cell_phones[0]->stu_filename)
                        <img id="signature_img" src="data:image/png;base64,{{ $cell_phones[0]->stu_base64 }}"/>
                    @endif
                </div>
            </div>
            <div class="main_box2">
                <div class="img_box_2">
                    @if($cell_phones[0]->stu_filename)
                        <img id="signature_img" src="data:image/png;base64,{{ $cell_phones[0]->stu_base64 }}"/>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
<!-- <div class="main_box2">
    <img src="/img/tables/olleh_mobile_application_form_back_2.jpg">

</div>
<div class="main_box3">
    <img src="/img/tables/olleh_mobile_application_form_back_3.jpg">

</div> -->