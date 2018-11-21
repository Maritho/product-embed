(function() {
  tinymce.PluginManager.add( 'product', function( editor, url ) {
      editor.addButton('product', {
          title: 'Insert Product',
          cmd: 'product',
          text: 'Product Embed',
      });

      editor.addCommand('product', function() {
          var selectedText = editor.selection.getContent({
              'format': 'html'
          });

          var win = editor.windowManager.open({
            title: 'Product Embed',
            body: [
              {
                type: 'textbox',
                name: 'product',
                label: 'Product Name(*)',
                minWidth: 500,
                value: ''
              },
              {
                type: 'textbox',
                name: 'images',
                label: 'Product Images(*)',
                minWidth: 500,
                value: ''
              },
              {
                type: 'textbox',
                name: 'url',
                label: 'Landing Page(*)',
                minWidth: 500,
                value: ''
              },
              {
                type: 'textbox',
                name: 'price',
                label: 'Product Price',
                minWidth: 200,
                value: ''
              },
              {
                type: 'textbox',
                multiline: true,
                name: 'description',
                label: 'Descriptions',
                minWidth: 500,
                value: ''
              },
              {
                type: 'textbox',
                name: 'button',
                label: 'Button Text(*)',
                minWidth: 500,
                value: 'Ajukan Sekarang'
              }
            ],
            buttons: [
              {
                text: "Ok",
                subtype: "primary",
                onclick: function() {
                  win.submit();
                }
              },
              {
                text: "Cancel",
                onclick: function() {
                  win.close();
                }
              }
            ],
            onsubmit: function(e) {
              var params = [];
              if( e.data.product.length > 0 ) {
                params.push('product="' + e.data.product + '"');
              }
              if( e.data.images.length > 0 ) {
                params.push('images="' + e.data.images + '"');
              }
              if( e.data.url.length > 0 ) {
                params.push('url="' + e.data.url + '"');
              }
              if( e.data.price.length > 0 ) {
                params.push('price="' + e.data.price + '"');
              }
              if( e.data.description.length > 0 ) {
                params.push('description="' + e.data.description + '"');
              }
              if( e.data.button.length > 0 ) {
                params.push('button="' + e.data.button + '"');
              } else {
                params.push('button="Selengkapnya"');
              }
              var paramsString = ' ' + params.join(' ');
              
              if( e.data.images.length > 0 && e.data.url.length > 0 && e.data.product.length > 0) {
                editor.insertContent('[product '+paramsString+']');
              } else {
                tinymce.activeEditor.windowManager.alert('Images dan Landing Pages Tidak Boleh Kosong');
              }
            }
          });
          
      });
  });
  
})();