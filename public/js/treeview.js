$(document).ready(function () {
    $('.formSubmit').parsley();
    $('.formSubmit').on("submit", function (e) {
		var form = $(this);
		e.preventDefault();
		e.stopImmediatePropagation();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type: "POST",
			cache: false,
			url: form.attr('action'),
			data: form.serialize(),
			processData: true,
			success: function (json) {
				$('.success').removeClass('hidden');
				$('.success').addClass("slideInRight");
				$('.success').text(json.message);
				setTimeout(function () {
					$('.success').addClass('hidden');
                }, 2000);
			},
			error: function (json) { },
			dataType: "json"
		});
	});

var oTable = $('#data_table').DataTable({
    "destroy": true,
    "processing": true,
    "serverSide": true,
    "ordering": false,
    "autoWidth": false,
    "lengthMenu": [
        [10, 25, 50, 100, 500],
        [10, 25, 50, 100, 500]
    ],
    "ajax": "categoryData",
    "columns": [
        { data: 'id', name: 'id' },
        { data: 'title', name: 'title' },
        { data: 'action', name: 'action' },
    ],
});
});
$.fn.extend({
    treed: function (o) {
      
      var openedClass = 'glyphicon-minus-sign';
      var closedClass = 'glyphicon-plus-sign';
      console.log(o);
      
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };
      
        /* initialize each of the top levels */
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this);
            branch.prepend("");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        /* fire event from the dynamically added icon */
        tree.find('.branch .indicator').each(function(){
            $(this).on('click', function () {
                $(this).closest('li').click();
            });
        });
        /* fire event to open branch if the li contains an anchor instead of text */
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        /* fire event to open branch if the li contains a button instead of text */
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});
/* Initialization of treeviews */
$('#tree1').treed();

$('#data_table').on('click', '.deleted', function () {
    var id = $(this).attr('data-id');
    $('#btn_delete').click(function (e) {

        $.ajax({
            url: 'categoryDestroy/' + id,
            type: "GET",
            dataType: "json",
            success: function (data) {
                if (data.status == 'exists') {
                    $('#delete').modal('hide');
                    $('#exists').modal('show');

                } else {
                    $('#delete').modal('hide');
                    $('.success').removeClass('hidden');
                    $('.success').addClass("slideInRight");
                    $('.success').text(data.message);
                    setTimeout(function () {
                        $('.success').addClass('hidden');
                    }, 2000);
                    $('#data_table').DataTable().draw();
                }
            }
        });
    });
});
