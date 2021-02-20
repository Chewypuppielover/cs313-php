function a(link) {
   $('.tab').addClass('collapse');
   $('.nav-link').prop('disabled', false);
   //this.setAttribute('disabled');
   $(link).removeClass('collapse');
}

// onselect name=time_id value=instantaneous -> nam=duration set value=0;


var $table = $('#table');

function responseHandler(res) {
   $.each(res, function (i, row) {
      row.source = ucwords(row.source);
      row.school = ucwords(row.school);
      row.duration_type = ucwords(row.duration_type);
      row.casting_time_type = ucwords(row.casting_time_type);
      row.save_attack = ucwords(row.save_attack);
      row.lvl = (row.lvl == 0)? 'Cantrip': value;
   });
   return res;
}
function level(value) {
   if (value == 0) return "Cantrip ";
   if (value == 1) return value + "st-level ";
   if (value == 2) return value + "nd-level ";
   if (value == 3) return value + "rd-level ";
   return value + "th-level ";
}
function detailFormatter(index, row) {
   var html = []
   html.push(
      '<b>' + row.name + '</b>' + 
      '</br>\t' + level(row.lvl) + row.school + if(row.ritual)? "(ritual)" + if(row.concentration)? "(concentration)" +
      '</br>\tCasting time: ' + row.casting_time + ' ' + row.casting_time_type +
      '</br>\tRange: ' + row.range + ' ' + row.range_type +
      '</br>\tComponents: ' + row.components + if(row.component_desc)?(' (' + row.component_desc + ')' + if(row.consumed)? "(consumed)") +
      '</br>\tDuration: ' + row.duration + ' ' + row.duration_type +
      '<p>' + row.description + '</br>' + row.higher_desc + '</p>'
   );
   
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
            align: "center"
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
               return row.casting_time + ' ' + row.casting_time_type
            }
         }, {
            title: "Source",
            field: "source",
            sortable: true,
            visible: false,
            align: "center"
         }, {
            title: "School",
            field: "school",
            sortable: true,
            visible: false,
            align: "center"
         }, {
            title: "Duration",
            //field: ["duration", "duration_type"],
            sortable: true,
            align: "center",
            formatter: (value, row) => {
               return ((row.duration=='0')?'':(row.duration + " ")) + row.duration_type;
            }
         }, {
            title: "Save/Attack",
            field: "save_attack",
            sortable: true,
            visible: false,
            align: "center"
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