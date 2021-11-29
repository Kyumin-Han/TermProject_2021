<template>
    <div class="card text-center shadow-2xl">
        <figure class="px-10 pt-10">
            <div id="map" style="width:100%;height:400px;"></div>
            <div class="custom_zoomcontrol radius_border">
    </div>
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
        props : ['locations'],
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
            var mapTypeControl = new kakao.maps.MapTypeControl();
            map.addControl(mapTypeControl, kakao.maps.ControlPosition.TOPRIGHT);
            var zoomControl = new kakao.maps.ZoomControl();
            map.addControl(zoomControl, kakao.maps.ControlPosition.RIGHT);

            marker.setMap(map);

            

            var positions = [];

            this.locations.forEach(function(loc) {
                positions.push({
                    title: loc.충전소명,
                    latlng: new kakao.maps.LatLng(loc.위도, loc.경도),
                    lnt: loc.위도,
                    lng: loc.경도,
                    newaddress: loc.소재지도로명주소,
                    address: loc.소재지지번주소
                })
            })
            
            if (navigator.geolocation) {
    
                    // GeoLocation을 이용해서 접속 위치를 얻어옵니다
                    navigator.geolocation.getCurrentPosition(function(position) {
                        
                        var lat = position.coords.latitude, // 위도
                            lon = position.coords.longitude; // 경도
                        
                        var geocoder = new kakao.maps.services.Geocoder();
                        var callback = function(result, status) {
                            if(status === kakao.maps.services.Status.OK) {
                                var locate = result[0].address_name;
                                var target = locate.split(' ', 1);
                                for(var i = 0; i < positions.length; i++){
                                    var tempaddress = positions[i].newaddress
                                    if(tempaddress == null) {
                                        tempaddress = positions[i].address
                                    }
                                    if(tempaddress.search(target[0]) != -1)
                                        {var marker = new kakao.maps.Marker({
                                            map: map,
                                            position: positions[i].latlng,
                                            title: positions[i].title,
                                            clickable: true
                                        })
                                        var piwContent = `<div>${positions[i].title}`+`<a href='https://map.kakao.com/link/to/${positions[i].title},${positions[i].lnt},${positions[i].lng}'>길찾기</a></div>`
                                        var posinfo = new kakao.maps.InfoWindow({
                                            content : piwContent,
                                            removable : true
                                        })
                                        kakao.maps.event.addListener(marker, 'click', clickListener(map, marker, posinfo));}
                                    
                                }
                                function clickListener(map, marker, poswindow) {
                                    return function() {
                                        poswindow.open(map, marker);
                                    }
                                }
                                                    
                            }
                        }
                        var locPosition = new kakao.maps.LatLng(lat, lon), // 마커가 표시될 위치를 geolocation으로 얻어온 좌표로 생성합니다
                            message = '<div style="padding:5px;">현재 위치</div>'; // 인포윈도우에 표시될 내용입니다
                        
                        geocoder.coord2RegionCode(position.coords.longitude, position.coords.latitude, callback);
                        
                        
                        // 마커와 인포윈도우를 표시합니다
                        displayMarker(locPosition, message);
                            
                    });

            } 
            else { // HTML5의 GeoLocation을 사용할 수 없을때 마커 표시 위치와 인포윈도우 내용을 설정합니다
                    
                    var locPosition = new kakao.maps.LatLng(33.450701, 126.570667),    
                        message = 'geolocation을 사용할수 없어요..'
                        
                    displayMarker(locPosition, message);
            }
            function displayMarker(locPosition, message) {
                var marker = new kakao.maps.Marker({  
                    map: map, 
                    position: locPosition
                }); 
                var iwContent = message, // 인포윈도우에 표시할 내용
                    iwRemoveable = true;

                // 인포윈도우를 생성합니다
                var infowindow = new kakao.maps.InfoWindow({
                    content : iwContent,
                    removable : iwRemoveable
                });
                
                // 인포윈도우를 마커위에 표시합니다 
                infowindow.open(map, marker);
                
                // 지도 중심좌표를 접속위치로 변경합니다
                map.setCenter(locPosition); 
            }

            
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

    