<!DOCTYPE html>
<html>
    <head>
    <script src="/assets/js/core/jquery-3.7.1.min.js"></script>
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
                    top: 382px;
                    left: 200px;
                    font-size: 14px;
                    z-index: 1;
                }
                .img_box_1 span.passportnumber {
                    position: absolute;
                    top: 382px;
                    left: 452px;
                    font-size: 14px;
                    z-index: 1;
                } 
                .img_box_1 span.gender_m {
                    position: absolute;
                    top: 382px;
                    left: 648px;
                    font-size: 14px;
                    font-style: oblique;
                    z-index: 1;
                }
                .img_box_1 span.gender_f {
                    position: absolute;
                    top: 382px;
                    left: 686px;
                    font-size: 14px;
                    font-style: oblique;
                    z-index: 1;
                }
                .img_box_1 span.email {
                    position: absolute;
                    top: 406px;
                    left: 530px;
                    font-size: 14px;
                    z-index: 1;
                }
                .img_box_1 span.chooselastnumber {
                    position: absolute;
                    top: 690px;
                    left: 350px;
                    font-size: 14px;
                    z-index: 1;
                }
                .img_box_1 img#signature_img {
                    position: absolute;
                    top: 1030px;
                    left: 520px;
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
                .img_box_2 img#signature_img2_1 { 
                    position:relative;
                    margin-top: 310px;
                    margin-left: 540px;
                    font-size: 14px;
                    width: 150px;
                    height: 50px;
                    z-index: 1;
                }
                .img_box_2 img#signature_img2_2 {
                    position:relative;
                    margin-top: 276px;
                    margin-right: 190px;
                    font-size: 14px;
                    width: 100px;
                    height: 33px;
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
                    top: 312px;
                    left: 168px;
                    font-size: 12px;
                    z-index: 1;
                }
                .img_box_1 span.passportnumber {
                    position: absolute;
                    top: 312px;
                    left: 378px;
                    font-size: 12px;
                    z-index: 1;
                }
                .img_box_1 span.gender_m {
                    position: absolute;
                    top: 308px;
                    left: 549px;
                    font-size: 14px;
                    font-style: oblique;
                    z-index: 1;
                }
                .img_box_1 span.gender_f {
                    position: absolute;
                    top: 308px;
                    left: 560px;
                    font-size: 14px;
                    font-style: oblique;
                    z-index: 1;
                }
                .img_box_1 span.email {
                    position: absolute;
                    top: 332px;
                    left: 444px;
                    font-size: 12px;
                    z-index: 1;
                }
                .img_box_1 span.chooselastnumber {
                    position: absolute;
                    top: 564px;
                    left: 282px;
                    font-size: 12px;
                    z-index: 1;
                }
                .img_box_1 img#signature_img {
                    position: absolute;
                    top: 840px;
                    left: 426px;
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
                .img_box_2 img#signature_img2_1 {
                    position: absolute;
                    top: 1180px;
                    left: 474px;
                    font-size: 14px;
                    width: 150px;
                    height: 50px;
                    z-index: 1;
                }
                .img_box_2 img#signature_img2_2 {
                    position: absolute;
                    top: 1460px;
                    left: 196px;
                    font-size: 14px;
                    width: 100px;
                    height: 33px;
                    z-index: 1;
                }
            }
        </style>
        <script>
            window.onfocus = function(){ 
                setTimeout(function() {
                    window.close();
                }, 1000);
            }
        </script>
    </head>
    <body onload="javascript:window.print();">
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
                        <img id="signature_img2_1" src="data:image/png;base64,{{ $cell_phones[0]->stu_base64 }}"/>
                        <img id="signature_img2_2" src="data:image/png;base64,{{ $cell_phones[0]->stu_base64 }}"/>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>