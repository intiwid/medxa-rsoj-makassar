/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
  // Define changes to default configuration here.
  // For complete reference see:
  // https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

  // config.extraPlugins = "justify";

  // Set the most common block elements.
  config.format_tags = "p;h1;h2;h3;pre";

  // Simplify the dialog windows.
  config.removeDialogTabs = "image:advanced;link:advanced";

  config.uiColor = "#f1f1f1";
  config.height = 482;
  config.width = "18.5cm";

  // The toolbar groups arrangement, optimized for two toolbar rows.
  config.toolbarGroups = [
    { name: "clipboard", groups: ["clipboard", "undo"] },
    {
      name: "editing",
      groups: ["find", "selection", "spellchecker", "editing"],
    },
    { name: "links", groups: ["links"] },
    { name: "insert", groups: ["Youtube", "insert"] },
    { name: "forms", groups: ["forms"] },
    { name: "tools", groups: ["tools"] },
    { name: "document", groups: ["mode", "document", "doctools"] },
    { name: "others", groups: ["others"] },
    "/",
    { name: "basicstyles", groups: ["basicstyles", "cleanup"] },
    {
      name: "paragraph",
      groups: ["list", "indent", "blocks", "align", "bidi", "paragraph"],
    },
    { name: "styles", groups: ["styles"] },
    { name: "colors", groups: ["colors"] },
    { name: "about", groups: ["about"] },
  ];
  // Remove some buttons provided by the standard plugins, which are
  // not needed in the Standard(s) toolbar.
  config.removeButtons =
    "Unlink,Link,Font,BulletedList,Subscript,Superscript,Strike,PasteText,PasteFromWord,Scayt,Anchor,RemoveFormat,NumberedList,Outdent,Indent,Blockquote,JustifyBlock,Styles,Format,About,Image,Table,HorizontalRule,SpecialChar";
};

// untuk paste di ckeditor
CKEDITOR.on("instanceReady", function (event) {
  event.editor.on("beforeCommandExec", function (event) {
    // Show the paste dialog for the paste buttons and right-click paste
    if (event.data.name == "paste") {
      event.editor._.forcePasteDialog = true;
    }
    // Don't show the paste dialog for Ctrl+Shift+V
    if (
      event.data.name == "pastetext" &&
      event.data.commandData.from == "keystrokeHandler"
    ) {
      event.cancel();
    }
  });
});
