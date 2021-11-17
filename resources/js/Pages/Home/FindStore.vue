<template>
    <div class="card text-center shadow-2xl">
        <figure class="px-10 pt-10">
            <div id="map" style="width:100%;height:400px;"></div>
        </figure>
            <div class="card-body">
                <h2 class="card-title"></h2>
                <p>지도에서 충전소 찾기</p>
                <div class="justify-center card-actions">
                    <button class="btn btn-outline btn-accent">More info</button>
                </div>
            </div>
        </div>
    </template>

<script>
    export default {
        methods: {
            initMap() {
                var mapContainer = document.getElementById('map'),
                mapOption = {
                    center: new kakao.maps.LatLng(37.23580406, 126.8738968),
                    level: 3,
                };
                
            var map = new kakao.maps.Map(mapContainer, mapOption);

            var markerPosition = new kakao.maps.LatLng(37.23580406, 126.8738968);

            var marker = new kakao.maps.Marker({
                position : markerPosition
            });

            marker.setMap(map);

            var positions = [
                {
                    title: '카카오', 
                    latlng: new kakao.maps.LatLng(33.450705, 126.570677)
                },
                {
                    title: '생태연못', 
                    latlng: new kakao.maps.LatLng(33.450936, 126.569477)
                },
                {
                    title: '텃밭', 
                    latlng: new kakao.maps.LatLng(33.450879, 126.569940)
                },
                {
                    title: '근린공원',
                    latlng: new kakao.maps.LatLng(33.451393, 126.570738)
                }
            ];

            for(var i = 0; i < positions.length; i++){
                var marker = new kakao.maps.Marker({
                    map: map,
                    position: positions[i].latlng,
                    title: positions[i].title,
                })
            }
            
            }
        },
        mounted() {
            if(window.kakao && window.kakao.maps) {
                this.initMap();
            } else {
                const script = document.createElement('script');
                script.src = "//dapi.kakao.com/v2/maps/sdk.js?autoload=false&appkey=51e5c001758d8de292d6f382daf5f9e7";
                script.onload = () => kakao.maps.load(this.initMap);
                document.head.appendChild(script);
            }
        }
    }
</script>

    