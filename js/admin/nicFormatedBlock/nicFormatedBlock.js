
/**
 * nicExample
 * @description: An example button plugin for nicEdit
 * @requires: nicCore, nicPane, nicAdvancedButton
 * @author: Brian Kirchoff
 * @version: 0.9.0
 */

/* START CONFIG */
youCode = '<div class="news-title"><h2 class="title-pink-inverse">Заголовок</h2></div>';
youCode1 = '<div class="news-title"><h2 class="title-pink">Заголовок</h2></div>';
youCode2 = '<h3 class="title-pink-inverse">заголовок 3</h3>';
youCode3 = '<h3 class="title-pink">заголовок 3</h3>';
youCode4 = '<div class="row">text<\/div><br>';
youCode5 = '<div class="row"><div class="col-6">col 1<\/div><div class="col-6">col2<\/div><\/div><br>';
youCode6 = '<ol class="about-list"><li class="about-list__item">элемент списка<\/li><\/ol>';
youCode7 = '<ol class="list-cirkle-number"><li>элемент списка</li></ol>';
youCode8 = '<blockquote class="quote-left-line"><p>здесь должна быть цитата</p><cite>автор</cite></blockquote><br>';
youCode9 = '<blockquote class="quote-cirkle"><p>здесь должна быть цитата</p><cite>автор</cite></blockquote><br>';
var nicFormatedBlockOptions = {
    buttons: {
        'block': {name: __('H2 inverse'), type: 'nicFormatedBlockButton'},
        'block1': {name: __('H2'), type: 'nicFormatedBlockButton1'},
        'block2': {name: __('h3'), type: 'nicFormatedBlockButton2'},
        'block3': {name: __('h3'), type: 'nicFormatedBlockButton3'},
        'block4': {name: __('одна колонка'), type: 'nicFormatedBlockButton4'},
        'block5': {name: __('две колонки'), type: 'nicFormatedBlockButton5'},
        'block6': {name: __('список'), type: 'nicFormatedBlockButton6'},
        'block7': {name: __('список2'), type: 'nicFormatedBlockButton7'},
        'block8': {name: __('цитата'), type: 'nicFormatedBlockButton8'},
        'block9': {name: __('цитата2'), type: 'nicFormatedBlockButton9'},
        'blanc': {name: __(''), type: 'nicFormatedBlockButton10'},
    }/* NICEDIT_REMOVE_START */,
    iconFiles: {
        'block': './../../js/admin/nicFormatedBlock/icons/h2i.gif',
        'block1': './../../js/admin/nicFormatedBlock/icons/h2.gif',
        'block2': './../../js/admin/nicFormatedBlock/icons/h3i.gif',
        'block3': './../../js/admin/nicFormatedBlock/icons/h3.gif',
        'block4': './../../js/admin/nicFormatedBlock/icons/save3.gif',
        'block5': './../../js/admin/nicFormatedBlock/icons/save4.gif',
        'block6': './../../js/admin/nicFormatedBlock/icons/save2.gif',
        'block7': './../../js/admin/nicFormatedBlock/icons/b5.gif',
        'block8': './../../js/admin/nicFormatedBlock/icons/citate2.gif',
        'block9': './../../js/admin/nicFormatedBlock/icons/citate.gif'
    }/* NICEDIT_REMOVE_END */
};
/* END CONFIG */

var nicFormatedBlockButton = nicEditorButton.extend({
    mouseClick: function () {
        this.ne.nicCommand('insertHTML', youCode);
    }
});
var nicFormatedBlockButton1 = nicEditorButton.extend({
    mouseClick: function () {
        this.ne.nicCommand('insertHTML', youCode1);
    }
});
var nicFormatedBlockButton2 = nicEditorButton.extend({
    mouseClick: function () {
        this.ne.nicCommand('insertHTML', youCode2);
    }
});
var nicFormatedBlockButton3 = nicEditorButton.extend({
    mouseClick: function () {
        this.ne.nicCommand('insertHTML', youCode3);
    }
});
var nicFormatedBlockButton4 = nicEditorButton.extend({
    mouseClick: function () {
        this.ne.nicCommand('insertHTML', youCode4);
    }
});
var nicFormatedBlockButton5 = nicEditorButton.extend({
    mouseClick: function () {
        this.ne.nicCommand('insertHTML', youCode5);
    }
});
var nicFormatedBlockButton6 = nicEditorButton.extend({
    mouseClick: function () {
        this.ne.nicCommand('insertHTML', youCode6);
    }
});
var nicFormatedBlockButton7 = nicEditorButton.extend({
    mouseClick: function () {
        this.ne.nicCommand('insertHTML', youCode7);
    }
});
var nicFormatedBlockButton8 = nicEditorButton.extend({
    mouseClick: function () {
        this.ne.nicCommand('insertHTML', youCode8);
    }
});
var nicFormatedBlockButton9 = nicEditorButton.extend({
    mouseClick: function () {
        this.ne.nicCommand('insertHTML', youCode9);
    }
});
var nicFormatedBlockButton10 = nicEditorButton.extend({
    mouseClick: function () {

    }
});

nicEditors.registerPlugin(nicPlugin, nicFormatedBlockOptions);