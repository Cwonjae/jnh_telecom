<!DOCTYPE html>
<html>
    <head>
        <script src="/assets/js/core/jquery-3.7.1.min.js"></script>
        <script>
            $(function () {
                $('#form_submit').click(function() {
                    formCheck();
                });

                $('#cancel').click(function() {
                    window.close();
                });
            });

            function formCheck() {
                if($('#reason').val() == 'etc') {
                    var details_reason = $('#details_reason').val();
                    if(!details_reason) {
                        alert('상세사유를 작성해주세요');
                    } else {
                        $('#download_logs').submit();
                        setTimeout('closed()',10000);
                    }
                } else {
                    $('#download_logs').submit();
                    setTimeout('closed()',10000);
                }
            }

            function selfClose() {
                self.close();
            }
        </script>
        <style>
            .main_div { width: 100%; text-align: center; margin: 0 auto; }
            .title_div { width: 100%; height: 60px; margin-bottom: 20px; }
            .title { text-align: center; display: inline-block; clear: both; width: 90%; padding-top: 20px; }
            .form_div { width: 100%; height: auto; }
            .sub_div { width: 90%; margin: 0 auto; }
            .select_div { width: 100%; height: 40px; }
            .select_div .reason { width:200px; }
            .textarea_div { width: 100%; height: auto; }
            .textarea_div textarea { resize:none; }
            label { float:left; }

            .button_div { width: 100%; height: 60px; margin-top: 30px; }
            .submit_div { width: 50%; height: auto; float: left; }
            .form_submit { display: block; background: #1a70bd; color: #fff; padding: 10px; cursor: pointer; width: 90%; margin: 0 auto; font-weight: bold; }
            .cancel_div { width: 50%; height: auto; float: right; }
            .cancel { display: block; background: #bd661a; color: #fff; padding: 10px; cursor: pointer; width: 90%; margin: 0 auto; font-weight: bold; }
        </style>
    </head>
    <body>
        <div class="main_div">
            <div class="title_div">
                <div class="title">
                    <span>파일다운로드</span>
                </div>
            </div>
            <div class="form_div">
                <div class="sub_div">
                    <form method="POST" action="{{ route('page.logsinsert', ['page' => 'users', 'filename' => $filename ]) }}" id="download_logs" enctype="multipart/form-data">
                    @csrf
                        <div class="select_div">
                            <label for="reason">사유</label>
                            <select class="reason" id="reason" name="reason">
                                <option value="agency_check" selected>통신사 비교용</option>
                                <option value="agency_submission">제출용</option>
                                <option value="etc">기타사유</option>
                            </select>
                        </div>
                        <div class="textarea_div">
                            <label for="details_reason">상세사유</label>
                            <textarea id="details_reason" name="details_reason" rows="5" cols="33"></textarea>
                        </div>
                    </form>
                </div>
                <div class="button_div">
                    <div class="submit_div">
                        <a class="form_submit" id="form_submit">다운로드</a>
                    </div>
                    <div class="cancel_div">
                        <a class="cancel" id="cancel">취소</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>