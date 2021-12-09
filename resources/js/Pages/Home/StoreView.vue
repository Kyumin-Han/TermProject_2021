<template>
    <div class="card text-center shadow-2xl">
        <figure class="px-10 pt-10">
            <div id="map" style="width:100%;height:400px;"></div>
            <div class="custom_zoomcontrol radius_border"></div>
        </figure>
        <div class="card-body">
            <h2 class="card-title">{{ store.충전소명 }}</h2>
            <h2 class="card-title">영업 시간 : {{ store.이용가능시작시각 }} ~ {{ store.이용가능종료시각 }}</h2>
            <h2 class="card-title">충전기 타입 : {{ store.급속충전타입구분 }}</h2>
            <h2 class="card-title">무료 주차 : {{ store.주차료부과여부 == 'Y' ? '주차료 부과' : '무료 주차 가능' }}</h2>
            <h2 class="card-title">전화 번호 : {{ store.관리업체전화번호 == null ? '-' : store.관리업체전화번호 }}({{ store.관리업체명 }})</h2>
        </div>
    </div>
</template>

<script>

    
    export default {
        props : ['store'],
        components : {
        },
        data() {
            return {
                lat: this.store.위도,
                lng: this.store.경도,
                name: this.store.충전소명
            }
        }, 
        methods: {
            initMap() {
                var mapContainer = document.getElementById('map'),
                mapOption = {
                    center: new kakao.maps.LatLng(this.lat, this.lng),
                    level: 3,
                };
                    
                var map = new kakao.maps.Map(mapContainer, mapOption);

                var mapTypeControl = new kakao.maps.MapTypeControl();
                map.addControl(mapTypeControl, kakao.maps.ControlPosition.TOPRIGHT);
                var zoomControl = new kakao.maps.ZoomControl();
                map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);

                var markerPosition  = new kakao.maps.LatLng(this.lat, this.lng); 

                var marker = new kakao.maps.Marker({
                    position: markerPosition
                });

                // 마커가 지도 위에 표시되도록 설정합니다
                marker.setMap(map);

                var iwContent = `<div>${this.store.충전소명}`+`<br><a href='https://map.kakao.com/link/to/${this.store.충전소명},${this.store.위도},${this.store.경도}'>길찾기</a></div>`
                var iwPosition = new kakao.maps.LatLng(this.lat, this.lng); //인포윈도우 표시 위치입니다

                // 인포윈도우를 생성합니다
                var infowindow = new kakao.maps.InfoWindow({
                    position : iwPosition, 
                    content : iwContent 
                });
                
                // 마커 위에 인포윈도우를 표시합니다. 두번째 파라미터인 marker를 넣어주지 않으면 지도 위에 표시됩니다
                infowindow.open(map, marker); 
            },
            
        },
        mounted() {
            if(window.kakao && window.kakao.maps) {
                this.initMap();
            } else {
                const script = document.createElement('script');
                script.src = "//dapi.kakao.com/v2/maps/sdk.js?autoload=false&libraries=services&appkey=51e5c001758d8de292d6f382daf5f9e7";
                script.onload = () => kakao.maps.load(this.initMap);
                document.head.appendChild(script);
            }
        }
    }
</script>

    