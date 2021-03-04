package com.example.userevent

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.View
import android.widget.Button
import android.widget.EditText
import kotlinx.android.synthetic.main.activity_main_02.*
import kotlinx.android.synthetic.main.activity_main_02.view.*
import android.widget.TextView

class MainActivity : AppCompatActivity() {
    private EditText edittext;
    private TextView textview;
    private Button button;

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        btn1 = (Button) findViewById(R.id.button01);
        button = (BUtton) findViewById(R.id.button);
        textview = (TextView) findViewById(R.id.textview)
        edittext = (EditText) findViewById(R.id.editText) ;
        //btn = (Button) findViewById(R.id.button);

        setContentView(R.layout.activity_main_02);

        button.SetOnClickListener(new View.OnClickListener(){
            public void onClick(View v){
                showTextView(v);
            }
        })

    }
    public void showTextView(View view)
    {
        EditText input = edittext.getText();
        textview.setText(input);
    }
}
