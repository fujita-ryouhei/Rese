// public/js/custom.js

$(document).ready(function () {
    // ユーザーが日付を選択した時のイベント
    $('#date').change(function () {
        updateSelectedInfo();
    });

    // ユーザーが時間を選択した時のイベント
    $('#time').change(function () {
        updateSelectedInfo();
    });

    // ユーザーが人数を選択した時のイベント
    $('#number').change(function () {
        updateSelectedInfo();
    });

    // ページロード時にも一度実行
    updateSelectedInfo();

    // 以下で日付、時間、数値の選択肢を動的に生成する処理を追加

    // 選択情報を更新する関数
    function updateSelectedInfo() {
        var selectedDate = $('#date').val() || '選択されていません';
        var selectedTime = $('#time').val() || '選択されていません';
        var selectedNumber = $('#number').val() || '選択されていません';

        // 選択されたデータを表示
        $('#selectedDate').text(selectedDate);
        $('#selectedTime').text(selectedTime);
        $('#selectedNumber').text(selectedNumber);
    }
});
