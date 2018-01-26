curl -XDELETE   'http://10.83.0.44:9201/equery?pretty'  -H 'Content-Type: application/json'
curl -XPUT      'http://10.83.0.44:9201/equery?pretty'  -H 'Content-Type: application/json' -d '
{
    "mappings": {
        "equery": {
            "dynamic":false,
            "properties": {
                "field1": {"type": "text"       },
                "field2": {"type": "keyword"    },
                "field3": {"type": "integer"    },
                "field4": {"type": "date",      "doc_values": true,     "format": "yyyy-MM-dd HH:mm:ss||epoch_millis||date_hour_minute_second||date_time_no_millis"}
            }
        }
    }
}'

curl -XPUT 'http://10.83.0.44:9201/equery/equery/1?pretty'  -H 'Content-Type: application/json' -d '
{
                "field1": "to be or not to be",
                "field2": "to be",
                "field3": 9,
                "field4": "2014-09-11 10:10:10"
}'

curl -XPUT 'http://10.83.0.44:9201/equery/equery/2?pretty'  -H 'Content-Type: application/json' -d '
{
                "field2": "to be2",
                "field3": 8,
                "field4": "2014-09-12 10:10:10"
}'

curl -XPUT 'http://10.83.0.44:9201/equery/equery/3?pretty'  -H 'Content-Type: application/json' -d '
{
                "field1": "or not to be",
                "field2": "to be2",
                "field3": 8,
                "field4": "2014-09-13 10:10:10"
}'

