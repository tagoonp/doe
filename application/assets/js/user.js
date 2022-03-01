function toggleActiveApplication(sys, uid, current_stage){
    var param = {
        system: sys,
        uid: uid,
        cstage: current_stage
    }
    var jxr = $.post(api + 'user?stage=toggle_app', param, function(){}, 'json')
                   .always(function(snap){
                       console.log(snap);
                       if(snap.status != 'Success'){
                            Swal.fire({
                                icon: "error",
                                title: 'เกิดข้อผิดพลาด',
                                text: 'ไม่สามารถดำเนินการได้',
                                confirmButtonClass: 'btn btn-danger',
                            })
                            return ;
                       }
                   })
}