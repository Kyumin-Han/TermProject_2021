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
                    center: new kakao.maps.LatLng(33.450701, 126.570667),
                    level: 3,
                };
                
            var map = new kakao.maps.Map(mapContainer, mapOption);

            var positions = [
                {
                    id: 1,
                    store: '학생문화관점',
                    location: '학생문화관 지하1층 로비',
                    time: '학기 중: 월~금 08:30~19:00 | 토 09:00~14:00',
                    vacation: '방학 중: 월~금 08:30~18:00 | 토 09:00~14:00',
                    tel: '02-3277-3707',
                    latlng: new kakao.maps.LatLng(37.562632898194835, 126.9454282268269)
                }
            ]

            var imageSrc = require('@/assets/marker.png'),
            imageSize = new kakao.maps.Size(24, 35),
            imageOption = { offset : new kakao.maps.Point(20, 35)};

            var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption);

            positions.forEach(fucntion(pos) {
                var marker = new kakao.maps.Marker({
                    map: map,
                    position: pos.latlng,
                    image: markerImage,
                });
            })
            
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

    