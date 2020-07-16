<fieldset>
<legend>帳號管理</legend>

<form action="./api/deluser.php" method="post">
    <table class="ct">
        <tr>
            <td class="clo">帳號</td>
            <td>密碼</td>
            <td>刪除</td>
        </tr>
    <?php
    $users=$User->all();
    foreach ($users as $u){
        if($u['acc']!='admin'){
    ?>
        <tr>
            <td><?=$u['acc'];?></td>
            <td><?=str_repeat("*",strlen($u['pw']));?></td>
            <td><input type="checkbox" name="del[]" value="<?=$u['id'];?>"></td>
        </tr>
    <?php } }?>
    </table>
    <div class="ct">
    
        <input type="submit" value="確定刪除">
        <input type="reset" value="清空選取">
    </div>
</form>
<h1>新增會員</h1>
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
                <button onclick="reg()">新增</button><button onclick="location=location">清除</button>
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
                        // alert("註冊完成，歡迎加入");
                        // location.href="index.php?do=login";
                        location.reload();
                    })
                }
            })
        }
    }
</script>

</fieldset>