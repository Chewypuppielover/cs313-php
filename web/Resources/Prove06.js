var $table = $('#table')

function responseHandler(res) {
   $.each(res.rows, function (i, row) {
      console.log(row);
   })
   return res
}
function detailFormatter(index, row) {
   var html = []
   $.each(row, function (key, value) {
      // html.push('<p><b>' + key + ':</b> ' + value + '</p>')
   })
   return html.join('')
}

function initTable() {
   $table.bootstrapTable('destroy').bootstrapTable({
      height: 550,
      local: "en-US",
      columns: [
         [{
            title: "Level",
            field: "lvl",
            sortable: true,
            align: "center"
         }, {
            title: "Spell Name",
            field: "name",
            sortable: true,
            align: "center"
         }, {
            title: "R/C",
            // field: ["ritual", "concentration"],
            align: "center"
         }, {
            title: "Casting Time",
            field: "lengths.casting_time_id",
            sortable: true,
            align: "center"
         }, {
            title: "Source",
            field: "sources.source_id",
            sortable: true,
            visible: false,
            align: "center"
         }, {
            title: "School",
            field: "schools.school_id",
            sortable: true,
            visible: false,
            align: "center"
         }, {
            title: "Duration",
            field: "lengths.duration_id",
            sortable: true,
            align: "center"
         }, {
            title: "Save/Attack",
            field: "saves_attacks.save_id",
            sortable: true,
            visible: false,
            align: "center"
         }, {
            title: "Range",
            //field: ["range", "rannge_type"],
            sortable: true,
            visible: false,
            align: "center"
         }, {
            title: "Area",
            field: "area",
            sortable: true,
            visible: false,
            align: "center"
         }, {
            title: "Components",
            //field: ["components", "component_desc", "consumed"],
            sortable: true,
            visible: false,
            align: "center"
         }, {
            title: "Description",
            field: "description",
            sortable: true,
            visible: false,
            align: "center"
         }, {
            title: "Description Higher",
            field: "higher_desc",
            sortable: true,
            visible: false,
            align: "center"
         }, {
            title: "Classes",
            field: "classes.class_id",
            visible: false,
            sortable: true,
            align: "center"
      }]]
   })
}

$(function() { initTable() })