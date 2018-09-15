var editors = [
    "api", "multi-threading", "unicode-strings", "gui", "web"
];

editors.forEach(function (item, i, arr) {
    var editor = ace.edit(item);
    //editor.setTheme("ace/theme/xcode");
    editor.setReadOnly(true);
    editor.session.setMode("ace/mode/php");
});