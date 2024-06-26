# from django.shortcuts import render
from api.serializers.doctor_serializer import HospitalSerializer, SpecialtySerializer
from rest_framework import serializers, status
from rest_framework.response import Response
from rest_framework.views import APIView
from utils.stop_words import specialties
from utils.text_processing import give_disease, is_input_valid


class PredictDoctorView(APIView):
    class InputSerializer(serializers.Serializer):
        symptoms = serializers.CharField()

    class OutputSerializer(serializers.Serializer):
        name = serializers.CharField()
        specialty = SpecialtySerializer()
        phone_number = serializers.CharField()
        email = serializers.CharField()
        hospital = HospitalSerializer()

    def post(self, request, *args, **kwargs):
        result = []
        serializer = self.InputSerializer(data=request.data)
        serializer.is_valid(raise_exception=True)
        symptoms = request.data["symptoms"]
        if not is_input_valid(symptoms):
            return Response(
                data={"data": "Please enter valid text"},
                status=status.HTTP_200_OK,
            )

        diseases = give_disease(input_text=symptoms)

        if not diseases:
            return Response(
                data={
                    "data": "Sorry we couldn't find you a doctor. Sorry for inconvenience."
                },
                status=status.HTTP_200_OK,
            )
        for disease in diseases:
            for key, values in specialties.items():
                if disease in values:
                    res = {disease : key}
                    if res not in result:
                        result.append(res)
        return Response(data={"data": result}, status=status.HTTP_200_OK)
