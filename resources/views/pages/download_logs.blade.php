<!DOCTYPE html>
<html>
    <head>
        <script src="/assets/js/core/jquery-3.7.1.min.js"></script>
        <script>
            $(function () {

            });
        </script>
    </head>
    <body>
        <div>
            <div>
                <span>파일다운로드</span>
            </div>
            <div>
                <div>
                    <form method="POST" action="{{ route('page.logsinsert', ['page' => 'users', 'filename' => $filename ]) }}" id="download_logs" enctype="multipart/form-data">
                    @csrf
                        <label for="reason">사유</label>
                        <select class="reason" id="reason">
                            <option value="agency_check" selected>통신사 비교용</option>
                            <option value="agency_submission">제출용</option>
                            <option value="etc">기타사유</option>
                        </select>
                        <label for="details_reason">상세사유</label>
                        <textarea id="details_reason" name="details_reason" rows="5" cols="33"></textarea>
                    </form>
                </div>
                <div class="text-center">
                    <a id="form_submit">다운로드</a>
                    <a id="cancel">취소</a>
                </div>
            </div>
        </div>
    </body>
</html>