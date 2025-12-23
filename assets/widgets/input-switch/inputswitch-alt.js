(function( $ ) {
    $.fn.simpleCheckbox = function(options) {
        var defaults = {
            newElementClass: 'switch-toggle',
            activeElementClass: 'switch-on'
        };
        var options = $.extend(defaults, options);
        this.each(function() {
            //Assign the current checkbox to obj
            var obj = $(this);
            //Create new span element to be styled
            var newObj = $('<div/>', {
                'id': '#' + obj.attr('id'),
				'data-tb_id': obj.attr('tb_id'),
                'class': options.newElementClass,
                'style': 'display: block;'
            }).insertAfter(this);
            //Make sure pre-checked boxes are rendered as checked
            if(obj.is(':checked')) {
                newObj.addClass(options.activeElementClass);
            }
            obj.hide(); //Hide original checkbox
            //Labels can be painful, let's fix that
            if($('[for=' + obj.attr('id') + ']').length) {

                var label = $('[for=' + obj.attr('id') + ']');
                label.click(function() {
                    newObj.trigger('click'); //Force the label to fire our element
                    return false;
                });
            }
            //Attach a click handler
            newObj.click(function() {
				
				
                //Assign current clicked object
                var obj = $(this);
				// @ sk(5717)
				var id=obj.attr('id');
				id=id.split('#')[1];
				var tbl_id=obj.data("tb_id");
				if(obj.hasClass(options.activeElementClass)){ 
                var status=0;	
                }
				else
				{
				var status=1;
				}
				console.log(tbl_id)
				toggleSwitch(id,tbl_id,status);
				// end @sk
                //Check the current state of the checkbox
                if(obj.hasClass(options.activeElementClass)) {
                    obj.removeClass(options.activeElementClass);
                    $(obj.attr('id')).attr('checked',false);
                } else {
                    obj.addClass(options.activeElementClass);
                    $(obj.attr('id')).attr('checked',true);
                }
                //Kill the click function
                return false;
            });
        });
    };
})(jQuery);