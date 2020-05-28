function categoryselect(name,event)
{
    let documenttype = $('#uid').val();
    if(documenttype!=''){
        console.log(name,documenttype)
        $.ajax({
            url:AJAXURL('/checkEmployeeDocumentDuplicaty'),
            method:'get',
            data:{'user_id':name,'document_type':documenttype},
            success:function(response)
            {
                console.log(response)
                if(response==0 || response==null || response==''){
                       $('#Documentexist').empty()
                       $('#documentcheck1').removeAttr('disabled')
                }else{
                    $('#Documentexist').text('Document already exist!!').css({'color':'red'});
                    $('#documentcheck1').attr('disabled',true);
                }
            }
        });
    }else{
        // swal('Error','Select Employee First','error')
        // $('#EmployeeName').val('')
    }
}