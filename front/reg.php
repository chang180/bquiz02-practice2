<fieldset>
    <legend>會員註冊</legend>
    <div style="color:red">*請設定您要註冊的帳號及密碼(最長12個字元)</div>
    <table>
        <tr>
            <td>Step1:登入帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td>Step2:登入密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td>Step3:再次確認密碼</td>
            <td><input type="password" name="pw2" id="pw2"></td>
        </tr>
        <tr>
            <td>Step4:信箱(忘記密碼時使用)</td>
            <td><input type="email" name="email" id="email"></td>
        </tr>
        <tr>
            <td>
                <button onclick="reg()">註冊</button><button onclick="location=location">清除</button>
            </td>
            <td></td>
        </tr>
    </table>
</fieldset>

<script>
    function reg() {
        let acc = $("#acc").val();
        let pw = $("#pw").val();
        let pw2 = $("#pw2").val();
        let email = $("#email").val();
        if (acc == "" || pw == "" || pw2 == "" || email == "") {
            alert("不可空白");
        } else if (pw != pw2) {
            alert("密碼錯誤");
        } else {
            $.get("./api/chkacc.php", {
                acc
            }, function(res) {
                if (res == '1') {
                    alert("帳號重覆");
                } else {
                    $.post("./api/reg.php", {
                        acc,
                        pw,
                        email
                    }, function() {
                        alert("註冊完成，歡迎加入");
                        location.href="index.php?do=login";
                    })
                }
            })
        }
    }
</script>