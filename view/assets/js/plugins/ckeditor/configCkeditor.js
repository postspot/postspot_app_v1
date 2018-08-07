CKEDITOR.config.wordcount = {
	showParagraphs: false
}

var iniciaCkeditor = ( function() {
	return function() {
		CKEDITOR.replace( 'editor', {
			extraPlugins: 'wordcount',
			toolbarGroups : [
                { "name": "document", "groups": [ "doctools", "mode", "document" ] },
                { "name": "clipboard", "groups": [ "clipboard", "undo" ] },
                { "name": "editing", "groups": [ "find", "selection", "spellchecker", "editing" ] },
                { "name": "forms", "groups": [ "forms" ] },
                { "name": "basicstyles", "groups": [ "basicstyles", "cleanup" ] },
                { "name": "paragraph", "groups": [ "list", "indent", "blocks", "align", "bidi", "paragraph" ] },
                { "name": "links", "groups": [ "links" ] },
                { "name": "insert", "groups": [ "insert" ] },
                { "name": "styles", "groups": [ "styles" ] },
                { "name": "colors", "groups": [ "colors" ] },
                { "name": "tools", "groups": [ "tools" ] },
                { "name": "others", "groups": [ "others" ] },
                { "name": "about", "groups": [ "about" ] }
            ],
        
            removeButtons : 'Source,Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CopyFormatting,RemoveFormat,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,Image,Flash,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,Font,FontSize,ShowBlocks,About'
        });
	};
} )();