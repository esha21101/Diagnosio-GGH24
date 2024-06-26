FROM python:3.8

# turning off buffering to stdout/stderr in a docker container is mainly a concern of getting as much information
# from running application as fast as possible in the container log and not loosing anything in case of a crash.
ENV PYTHONUNBUFFERED 1

RUN apt-get update -y
RUN apt-get install -y binutils libproj-dev gdal-bin
RUN python -m pip install gunicorn

WORKDIR /backend-api

COPY ./HospitalManagement /backend-api/
COPY ./requirements.txt /backend-api/requirements.txt

RUN ls -a
RUN python -m pip install -r requirements.txt
RUN python -m spacy download en_core_web_md
RUN python -m pip install https://s3-us-west-2.amazonaws.com/ai2-s2-scispacy/releases/v0.5.1/en_core_sci_md-0.5.1.tar.gz
CMD ["python", "manage.py", "runserver", "0.0.0.0:8000"]