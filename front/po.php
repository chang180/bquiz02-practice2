<style>
    fieldset {
        display: inline;
        vertical-align: top;
    }

    #b1 .tags {
        color: blue;
    }

    #b1 {
        width: 20%;
    }

    #b2 {
        width: 70%;
    }
</style>

<h4>目前位置：首頁 > 分類網誌 > <span id="nav"></span></h4>

<fieldset id="b1">
    <legend>分類網誌</legend>
    <div class="tags" id="1">健康新知</div>
    <div class="tags" id="2">菸害防治</div>
    <div class="tags" id="3">癌症防治</div>
    <div class="tags" id="4">慢性病防治</div>
</fieldset>
<fieldset id="b2">
    <legend>文章列表</legend>
    <div id="list"></div>
</fieldset>

<script>
    $(".tags").on("click", function() {
        let type = $(this).attr("id");
        nav(type);
        getList(type);
    });

    function nav(id) {
        let text = $("#" + id).html();
        $("#nav").html(text);
    }



    function getList(type) {
        $.get("./api/getlist.php", {
            type
        }, function(list) {
            $("#list").html(list);
        })
    }
    getList(1);
    nav(1);

    function getNews(id) {
        $.get("./api/getnews.php", {
            id
        }, function(news) {
            $("#list").html(news);
        })
    }
</script>