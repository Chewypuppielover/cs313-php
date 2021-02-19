function a(link) {
   $('.tab').addClass('collapse');
   $('.nav-link').prop('disabled', false);
   //this.setAttribute('disabled');
   $(link).removeClass('collapse');
}

// onselect name=time_id value=instantaneous -> nam=duration set value=0;




var $table = $('#table');

function responseHandler(res) {
   console.log(res);
   $.each(res.rows, function (i, row) {
      row.source = ucwords(row.source);
      console.log(row);
   });
   return res;
}
function detailFormatter(index, row) {
   var html = []
   html.push('<p><b>' + row.description + ':</b> ' + row.higher_desc + '</p>');
   return html.join('');
}
function ucwords(str) {
   const words = str.split(" ");
   for (let i = 0; i < words.length; i++) {
      words[i] = words[i][0].toUpperCase() + words[i].substr(1);
   }
   return words.join(" ");
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
            align: "center",
            formatter: (value) => {
               if(value == 0) return 'Cantrip';
               else return value;
            }
         }, {
            title: "Spell Name",
            field: "name",
            sortable: true,
            align: "center"
         }, {
            title: "R/C",
            //field: ["ritual", "concentration"],
            align: "center",
            formatter: (value, row) => {
               return ((row.ritual)? 'Ritual ' : '') + ((row.concentration)? 'Concentration' : '')
            }
         }, {
            title: "Casting Time",
            //field: ["casting_time", "casting_time_type"],
            sortable: true,
            align: "center",
            formatter: (value, row) => {
               return row.casting_time + ' ' + ucwords(row.casting_time_type)
            }
         }, {
            title: "Source",
            field: "source",
            sortable: true,
            visible: false,
            align: "center",
            //formatter: (value) => { return ucwords(value) }
         }, {
            title: "School",
            field: "school",
            sortable: true,
            visible: false,
            align: "center",
            formatter: (value) => { return ucwords(value) }
         }, {
            title: "Duration",
            //field: ["duration", "duration_type"],
            sortable: true,
            align: "center",
            formatter: (value, row) => {
               return ((row.duration=='0')?'':(row.duration + " ")) + ucwords(row.duration_type)
            }
         }, {
            title: "Save/Attack",
            field: "save_attack",
            sortable: true,
            visible: false,
            align: "center",
            formatter: (value) => { return ucwords(value) }
         }, {
            title: "Range",
            //field: ["range", "range_type"],
            sortable: true,
            visible: false,
            align: "center",
            formatter: (value, row) => {
               return row.range + " " + row.range_type
            }
         }, {
            title: "Area",
            field: "area",
            sortable: true,
            visible: false,
            align: "center"
         }, {
            title: "Components",
            field: "components", // "component_desc", "consumed"],
            sortable: true,
            visible: false,
            align: "center",
            formatter: (value, row) => {
               return value + "</br>" + ((row.consumed)? 'Materials Consumed, ' : '') + row.component_desc
            }
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
         }/* , {
            title: "Classes",
            field: "classes.class_id",
            visible: false,
            sortable: true,
            align: "center"
      } */]]
   })
}

$(function() { initTable() })