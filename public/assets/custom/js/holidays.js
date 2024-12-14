$(document).ready(function(){
    var calendarUrl = 'https://www.googleapis.com/calendar/v3/calendars/en.philippines%23holiday%40group.v.calendar.google.com/events?key=AIzaSyASXdY-m2i_vBFdhn36_rmFE6b2aGZyN-M';

    $.getJSON(calendarUrl, function(data){

        let data_items_array = []

        for (item in data.items) {

            var currentYear = new Date().getFullYear();
            var outputDate = new Date(data.items[item].start.date).getFullYear();

            if (currentYear === outputDate) {

                data_items_array.push({
                    summary: data.items[item].summary,
                    start: data.items[item].start.date
                },)

            }
        }

        moment.suppressDeprecationWarnings = true;

        let newItems = []
        let dateArray = []

        data_items_array.forEach(event=> {
           dateArray.push({
              type: 'start',
              date: event.start
           })
        })

        dateArray = dateArray.sort((left, right) => {
           return moment(left.date).diff(moment(right.date))
        })

        // console.log(newItems);
        for (dateData in dateArray) {

            for (item in data.items) {

                if (dateArray[dateData].date === data.items[item].start.date) {

                var timestamp = data.items[item].start.date;
                var formattedDate = moment(timestamp).format('dddd <br> MMMM D, YYYY');

                    $("#cd-timeline").append(

                        '<div class="cd-timeline-block mt-5"> '+
                            '<div class="cd-timeline-img fables-second-background-color"></div>   '+
                            '<span class="cd-date fables-light-background-color fables-fifth-text-color">'+ formattedDate +'</span>'+
                            '<div class="cd-timeline-content mb-4"> '+
                                '<div class="row">'+
                                    '<div class=" ml-4 mb-3 col-12 col-lg-7 mt-3 mt-lg-0">'+
                                        '<h2 class="font-22 semi-font mb-2 mt-4"><a href="#" class="fables-main-text-color fables-second-hover-color">'+data.items[item].summary+'</a></h2> '+
                                    '</div>'+
                                '</div> '+
                            '</div>   '+
                        '</div>'
                    );
                }
            }
        }
    });

    $("div.cd-timeline-block").sort(function(a,b){
        return new Date($(a).attr("data-date")) > new Date($(b).attr("data-date"));
    }).each(function(){
        $("cd-timeline").prepend(this);
    })

});